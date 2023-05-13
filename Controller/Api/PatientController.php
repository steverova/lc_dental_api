<?php
require_once "./Entities/Patient.php";
require_once "./Model/PatientModel.php";
require_once "./Validations/Patient.validations.php";
class PatientController extends BaseController
{

    function createAction()
    {
        echo json_encode(array("message" => "respuesta del metodo create"));

        $patientModel = new PatientModel();
        $validations = new PatientValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $status = 1;

        $errorArray = array();

        if (strtoupper($requestMethod) == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $patient = new Patient(
                $data->id_card,
                $data->name,
                $data->last_name,
                $data->email,
                $data->phone_number,
                $data->location,
                $data->payer,
                $data->comments
            );

            $emailResponse = $patientModel->isEmailExist($data->email);
            $idResponse = $patientModel->isIdExist($data->id_card);

            array_push(
                $errorArray,
                array(
                    "id_message" => "ya se encuentra registrada",
                    "email_menssage" => "ya se encuentra registrado",
                    "email_status" =>  $emailResponse,
                    "id_status" => $idResponse
                )
            );

            if ($emailResponse === 1 && $idResponse === 1) {
                echo json_encode($errorArray);
                $this->sendOutput(
                    json_encode($errorArray),
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                );
            } else {
                if ($validations->validateCreate($patient)[0]) {
                    $stmt =  $patientModel->createPatient($patient);
                    $stmt->close();
                    echo json_encode(array("message" => "El registro se agrego exitosamente", "status" => $status));
                } else {
                    $strErrorHeader = "406 Not Acceptable";
                    $this->sendOutput(
                        $validations->validateCreate($patient)[1],
                        array('Content-Type: application/json', $strErrorHeader)
                    );
                }
            }
        }
    }

    function updateAction()
    {
        $patientModel = new PatientModel();
        $validations = new PatientValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'PUT') {
            $id_user = Utils::REQUEST_ID();
            $json = file_get_contents('php://input');
            $data = json_decode($json);

            $patient = new Patient(
                $id_user,
                $data->id_card,
                $data->name,
                $data->last_name,
                $data->email,
                $data->phone_number,
                $data->location,
                $data->payer,
                $data->comments
            );

            if ($validations->validateUpdate($patient)[0]) {
                $patientModel->updatePatient($patient);
                echo json_encode(array("message" => "El registro se actualizo exitosamente", "status" => 1));
            } else {
                $this->sendOutput($validations->validateUpdate($patient)[1]);
            }
        }
    }

    public function testAction(){
        echo "hola";
    }

    public function listAction()
    {
        $patientModel = new PatientModel();
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            $option = Utils::REQUEST_ID();
            if ($option == 0 || $option == 1) {

                try {
                    $arrUsers = $patientModel->getByOptions($option);
                    $responseData = json_encode($arrUsers);
                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
            } else {

                $arrUsers = $patientModel->getAllPatients();

                $responseData = json_encode($arrUsers);
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function searchAction()
    {
        $strErrorDesc = '';
        $patientModel = new PatientModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            $id_user = Utils::REQUEST_ID();
            $patient = $patientModel->searchPatient($id_user);
            $responseData = json_encode($patient);

            if (json_decode($responseData, true)) {
                $this->sendOutput(
                    $responseData,
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                );
            } else {

                $this->listAction();

                // $strErrorDesc = 'Not found data for this record';
                // $this->sendOutput(
                //     json_encode(array('error' => $strErrorDesc)),
                //     array('Content-Type: application/json', 'HTTP/1.1 200 OK'
                //     )
                // );
            }
        }
    }

    public function findByIdAction()
    {
        $strErrorDesc = '';
        $patientModel = new PatientModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            $id_user = Utils::REQUEST_ID();
            $patient = $patientModel->findById($id_user);
            $responseData = json_encode($patient);

            if (json_decode($responseData, true)) {
                $this->sendOutput(
                    $responseData,
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                );
            } else {
                $strErrorDesc = 'Not found data for this record';
                $strErrorHeader = 'HTTP/1.1 204 No Content';
                $this->sendOutput(
                    json_encode(array('error' => $strErrorDesc)),
                    array(
                        'Content-Type: application/json',
                        $strErrorHeader
                    )
                );
            }
        }
    }

    public function deleteAction()
    {
        $patientModel = new PatientModel();
        $validations = new PatientValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'DELETE') {
            $id = Utils::REQUEST_ID();
            if (
                $patientModel->isPatientsExist($id) &&
                $validations->isInteger($id)[0]
            ) {
                $patientModel->deletePatient($id);
                echo json_encode(array("message" => "Estado del paciente actualizado"));
            } else {
                echo json_encode(array("message" => "El usuario no existe"));
            }
        }
    }
}
