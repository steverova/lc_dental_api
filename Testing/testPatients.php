<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

require_once './Test.php';
require_once "./inc/bootstrap.php";
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class testPatients extends TestCase
{
    /** ----------------------------------------------- CRUD ------------------------------------------------**/
    /** @test **/

    // // /** @test **/
    public function testPatientUpdateSuccess()
    {
        $form = $this->data('update');
        $array = json_decode($form, true);
        $id_user = $array["id_user"];
        echo $id_user;
        $client = new Client();
        $response = $client->put('http://localhost/api/patient/update/' . $id_user, [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => $form
        ]);
        $body = $response->getBody();
        $bodyResponse = json_decode((string) $body);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("El registro se actualizo exitosamente", $bodyResponse->message);
    }

    public function testPatienCreateSuccess()
    {

        $form = $this->data('create');
        $client = new Client();
        $response = $client->post('http://localhost/api/patient/create', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => $form
        ]);
        $body = $response->getBody();

        $bodyResponse = json_decode((string) $body);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("El registro se agrego exitosamente", $bodyResponse->message);
    }

    public function testPatientDelete()
    {
        $client = new Client();
        $response = $client->delete('http://localhost/api/patient/delete/');
        $body = $response->getBody();
        $bodyResponse = json_decode((string) $body);
        print_r($bodyResponse);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("Estado del paciente actualizado", $bodyResponse->message);
    }

    public function data($option)
    {
        $data = array(
            "id_card" => 999312400,
            "name" => "michael",
            "last_name" => "Jackson",
            "email" => "Jackson400@dominio.com",
            "phone_number" => "68234400",
            "location" => "USA",
            "payer" => "Jackson",
            "comments" => "Agregado"
        );

        if ($option === 'create') {
            return json_encode($data);
        } else {
            $data['id_user'] = 78;
            return json_encode($data);
        }
    }


    /** ----------------------------------------------- Validations ------------------------------------------------**/

    public function testPatienCreateValidatePhone()
    {
        $form = $this->data('create');
        $array = json_decode($form);
        $array->phone_number = "682ccc34533";
        $form = json_encode($array);
        $client = new Client();
        $response = $client->post('http://localhost/api/patient/create', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body' => $form
        ]);
        $body = $response->getBody();

        $bodyResponse = json_decode((string) $body);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("record phone_number error in format number", $bodyResponse->message);
    }

    /** @test **/
    /* verifica si la controladora y el metodo consultado existen*/
    public function testRouteExists()
    {
        $uri = "localhost/api/patient/list";
        $uri = explode('/', $uri);
        $controller_name = $uri[2] . "Controller";
        $method_name = $uri[3] . 'Action';
        $route = "./Controller/Api/" . $controller_name . ".php";
        echo $route . "\n";
        $exist = is_file($route);
        $this->assertTrue($exist, 'Route file does not exist');
        if ($exist) {
            require_once PROJECT_ROOT_PATH . "/Controller/Api/" . $controller_name . ".php";
            $this->assertTrue(class_exists($controller_name), 'Controller class does not exist');
            $this->assertTrue(method_exists($controller_name, $method_name), 'Method does not exist');
        }
    }

    /*
    este test comprueba la coneccion a base de datos.
    */
    public function testConexionDB()
    {
        $connection = null;
        try {
            $this->$connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to database");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        $this->assertInstanceOf(mysqli::class, $this->$connection); // Comprobar que se ha establecido la conexión
    }

    public function testGetPatient()
    {
        $client = new Client();
        $response = $client->get('http://localhost/api/patient/list');
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertNotEmpty($data, "el json viene vacio");
        // $this->assertEmpty($data, "el json viene lleno");
    }
}
