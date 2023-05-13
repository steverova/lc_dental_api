<?php
require_once "./Entities/User.php";
require_once "./Model/LoginModel.php";
require_once "./Validations/User.validations.php";
require_once "./Controller/Api/jwt.php";



class LoginController extends BaseController
{
    public function registerAction()
    {
        $loginModel = new LoginModel();
        $validations = new UserValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $status = 1;

        if (strtoupper($requestMethod) == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $user = new User(
                $data->name,
                $data->last_name,
                $data->user_name,
                $data->password,
                $data->email,
                $status,
                $data->created_date,
            );

            if ($validations->validateCreate($user)[0]) {
                $result = $loginModel->register($user);
                echo json_encode(array("message" => "El registro se agrego exitosamente"));
                $result->close();
            } else {
                $strErrorHeader = "406 Not Acceptable";
                $this->sendOutput(
                    $validations->validateCreate($user)[1],
                    array('Content-Type: application/json', $strErrorHeader)
                );
            }
        }
    }

    public function generateConfirmCodeAction()
    {

        $loginModel = new LoginModel();
        $validations = new UserValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $user = new User(
                $data->id,
                $data->code,
            );

            if ($validations->validateCode($user)[0]) {
                $loginModel->generateConfirmCode($user);
                echo json_encode(array("message" => "Se genero el código exitosamente"));
            } else {
                $strErrorHeader = "406 Not Acceptable";
                $this->sendOutput(
                    $validations->validateCode($user)[1],
                    array('Content-Type: application/json', $strErrorHeader)
                );
            }
        }
    }

    public function confirmCodeAction()
    {
        $loginModel = new LoginModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);

            $id_user = $data->id_user;
            $code = $data->code;

            $dataResponse = $loginModel->confirmCode($id_user, $code);

            echo json_encode(array("message" => "Se genero la confirmación del código exitosamente"));
        }
    }

    public function activeUserAction()
    {

        $loginModel = new LoginModel();
        $validations = new Validations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);

            $id_user = $data->id_user;

            $loginModel->activeUser($id_user);
            echo json_encode(array("message" => "Se activo exitosamente el usuario"));
        }
    }

    public function loginUserAction()
    {

        $loginModel = new LoginModel();

        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);

            $result = $loginModel->loginUser($data);

            if (!empty($result[0])) {

                $user = $result[0];
                $headers = ['alg' => 'HS256', 'typ' => 'JWT'];
                $payload = ['user' => $user];
                $jwt = generate_jwt($headers, $payload);

                $this->sendOutput(
                    json_encode(array("user" => $jwt, "status" => 200)),
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                );
            } else {
                $response = array(
                    "errorMessage" => "Not found data for this record",
                    "status" => 204
                );

                echo  json_encode($response);
            }
        }
    }


    public function authAction()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {

            $loginModel = new LoginModel();
            $bearer_token = get_bearer_token();
            // echo $bearer_token;
            $is_jwt_valid = isset($bearer_token) ? is_jwt_valid($bearer_token) : false;

            if ($is_jwt_valid) {
                $user_name = getPayload($bearer_token)->user->user_name;
                if ($result = $loginModel->getUserByUsernameOrEmail($user_name)) {
                    echo json_encode($result[0]);
                }
            }
        }
    }


    public function updateUserAction()
    {

        $loginModel = new LoginModel();
        $validations = new UserValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'PUT') {
            $id = Utils::REQUEST_ID();
            $json = file_get_contents('php://input');
            $data = json_decode($json);

            $user = new User(
                $data->name,
                $data->last_name,
                $data->user_name,
                $data->password,
                $data->email,
                $data->id_user,
            );

            if ($validations->validateUpdate($user)[0]) {
                $loginModel->updateUser($user);
                echo json_encode(array("message" => "El registro se actualizo exitosamente"));
            } else {
                $this->sendOutput($validations->validateUpdate($user)[1]);
            }
        }
    }
}
