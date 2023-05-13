<?php

class Database
{
    protected $connection = null;
    // public function __construct()
    // {
    //     try {
    //         $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

    //         if (mysqli_connect_errno()) {
    //             throw new Exception("Could not connect to database.");
    //         }
    //     } catch (Exception $e) {
    //         throw new Exception($e->getMessage());
    //     }
    // }

    public function __construct()
    {
        try {
            $this->connection = mysqli_init();
            mysqli_ssl_set(
                $this->connection,
                null,
                null,
                'DigiCertGlobalRootCA.crt.pem',
                null,
                null
            );
            $this->connection->real_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
        } catch (Exception $e) {
            throw new Exception("Could not connect to database: " . $e->getMessage());
        }
    }

    public function select($query = "", $params = [])
    {

        try {
            $stmt = $this->executeStatement($query, $params);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $result;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function executeAction($query = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $params);
            return $stmt;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    private function executeStatement($query = "", $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query); ///trabajar lo que ocupa (LO QUE SE AGREGA Y EL RESULTADO DE LA BASE DE DATOS (ID))
            if ($stmt === false) {
                throw new Exception("Unable to do prepared statement: " . $query);
            }
            if ($params) {
                call_user_func_array(array($stmt, 'bind_param'), $this->BIND_PARAMS($params[0], $params[1]));
            }
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function BIND_PARAMS($datatype = [], $data = [])
    {
        //call_user_func_array(array($stmt, 'bind_param'), $this->BIND_PARAMS($params[0], $params[1]));
        $typeString = $datatype;
        $vals = $data;
        $valCount = count($vals);
        $args = array(&$typeString);
        for ($i = 0; $i < $valCount; $i++) {
            $args[] = &$vals[$i];
        }
        return $args;
    }
}
