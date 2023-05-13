<?php
require_once "./Entities/Setting.php";
require_once "./Model/SettingModel.php";
require_once "./Validations/Setting.validations.php";
class SettingController extends BaseController
{
    // Metodo de creacion para añadir pacientes 

    function createAction()
    {

        $settingMol = new SettingModel();
        $validations = new SettingValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $setting = new Setting(
                    $data->email,
                    $data->phone_number
            );
            
            if ($validations->validateCreate($setting)[0]) {
                $settingMol->createSetting($setting);
                Utils::console_log("validado");
                return true;
            } else {
                // Utils::console_log("ERROR!!");
                // $this->sendOutput($validations->validateCreate($setting)[1]);
            }
        }
    }

    function updateAction()
    {
        $settingMol = new SettingModel();
        $validations = new SettingValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'PUT') {
            $id_setting = Utils::REQUEST_ID();
            $json = file_get_contents('php://input');
            $data = json_decode($json);

            $setting = new Setting(
                $id_setting,
                $data->email,
                $data->phone_number,

            );

            if ($validations->validateUpdate($setting)[0]) {
                $settingMol->updateSetting($setting);
                echo json_encode(array("message" => "El registro se actualizo exitosamente", "status" => 1));
            } else {
                $this->sendOutput($validations->validateUpdate($setting)[1]);
            }
        }
    }

    public function listAction()
    {
        $settingMol = new SettingModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            $viewAppointment = $settingMol->getAllSetting();
            $responseData = json_encode($viewAppointment);
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


    public function findByIdAction()
    {
        $strErrorDesc = '';
        $settingMol = new SettingModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            $id_setting = Utils::REQUEST_ID();
            $setting = $settingMol->getSettingById($id_setting);
            $responseData = json_encode($setting);

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
        $settingMol = new SettingModel();
        $validations = new SettingValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'DELETE') {
            $id = Utils::REQUEST_ID();
            if (
                $settingMol->issettngExist($id) &&
                $validations->isInteger($id)[0]
            ) {
                $settingMol->deleteSetting($id);
                echo json_encode(array("message" => "Estado del paciente actualizado"));
            } else {
                echo json_encode(array("message" => "El usuario no existe"));
            }
        }
    }
}
