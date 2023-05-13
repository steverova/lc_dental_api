<?php
require_once "./Entities/Treatment.php";
require_once "./Model/TreatmentModel.php";
require_once './Validations/Validations.php';
require_once './Validations/Treatment.Validations.php';

class ServiceController  extends BaseController
{

    /*
    @param 
    name: string - not null,
    description: string - null,
    image: string base 64- not null 
     */

    function createAction()
    {
        $model = new TreatmentModel();
        $validations = new TreatmentValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $treatment = new Treatment(
                $data->name,
                $data->description,
                $data->image
            );

            if (!$validations->isValueEmpty($treatment)[0]) {
                $result = $model->create($treatment);
                if ($result->affected_rows === 1) {
                    echo json_encode(array("message" => "Registro agregado existosamente"));
                } else {
                    echo json_encode(array("message" => "Error, registro no se pudo agregar"));
                }
                $result->close();
            } else {
                $this->sendOutput($validations->isValueEmpty($data)[1]);
            }
        }
    }

    /*
    @param
    id_treatment: integer - not null
    name: string - not null,
    description: string - null,
    image: string base 64- not null 
     */

    function updateAction()
    {
        $model = new TreatmentModel();
        $validations = new TreatmentValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'PUT') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $treatment = new Treatment(
                $data->id_treatment,
                $data->name,
                $data->description,
                $data->image
            );

            $result = $model->isExists($data->id_treatment);
            if ($result) {
                if (!$validations->isValueEmpty($treatment)[0]) {
                    $result = $model->update($treatment);
                    if ($result->affected_rows === 1) {
                        $header = "HTTP/1.1 201 Created";
                        $json_response =  json_encode(array("message" => "Registro actualizado existosamente"));
                        $this->sendOutput(
                            $json_response,
                            array('Content-Type: application/json', $header)
                        );
                    }
                    $result->close();
                } else {
                    $this->sendOutput($validations->isValueEmpty($data)[1]);
                }
            } else {
                $header = 'HTTP/1.1 204 No Content';
                $json_response =  json_encode(array("message" => "No se encontro el registro"));
                $this->sendOutput(
                    $json_response,
                    array('Content-Type: application/json', $header)
                );
            }
        }
    }

    /*
    @param
    id_treatment: integer - not null 
     */
    public function deleteAction()
    {
        $model = new TreatmentModel();
        $validations = new Validations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'DELETE') {
            $id = Utils::REQUEST_ID();
            if ($validations->isInteger($id)[0]) {
                $result = $model->delete($id);
                if ($result->affected_rows === 1) {
                    echo json_encode(array("message" => "Registro eliminado existosamente"));
                } else {
                    $header = 'HTTP/1.1 204 No Content';
                    $json_response =  json_encode(array("message" => "No se encontro el registro"));
                    $this->sendOutput(
                        $json_response,
                        array('Content-Type: application/json', $header)
                    );
                }
            }
        }
    }
    public function listAction()
    {
        $model = new TreatmentModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            $result = $model->getAll();
            $responseData = json_encode($result);
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        }
    }

            /*
    @param
    id_treatment: integer - not null 
     */
    function findByIdAction()
    {
        $model = new TreatmentModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            $id_user = Utils::REQUEST_ID();
            $patient = $model->findById($id_user);
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

}
