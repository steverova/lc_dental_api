<?php
require_once  "./Entities/Appointment.php";
require_once  "./Model/AppointmentModel.php";
require_once "./Validations/Appointment.Validations.php";
class AppointmentController extends BaseController
{
    // Metodo de creacion para añadir pacientes 

    function createAction()
    {

        $appointmentModel = new AppointmentModel();
        $validations = new AppointmentValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $appointment = new Appointment(
                $data->id_patient,
                $data->date_appointment,
                $data->reason,
            );

            if ($validations->validateCreate($appointment)[0]) {
                $result = $appointmentModel->createAppointment($appointment);
                $result->close();
            } else {
                Utils::console_log("ERROR!!");
                $this->sendOutput($validations->validateCreate($appointment)[1]);
            }
        }
    }

    function updateAction()
    {
        $appoitmentModel = new AppointmentModel();
        $validations = new AppointmentValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'PUT') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $id = Utils::REQUEST_ID();

            $appoitment = new Appointment();
            $appoitment->paramstoUpdate(
                $id,
                $data->date_appointment,
                $data->reason
            );

            // $appoitmentModel->updateAppointment($appoitment);
            // Utils::console_log("validado");
            // return true;

            if ($validations->validateUpdate($appoitment)[0]) {
                $result = $appoitmentModel->updateAppointment($appoitment);
                $result->close();
            } else {
                Utils::console_log("ERROR!!");
                $this->sendOutput($validations->validateUpdate($appoitment)[1]);
            }
        }
    }
    public function listDataAction()
    {
        $strErrorDesc = '';
        $appointmentModel = new AppointmentModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $viewAppointment = $appointmentModel->getAppointmentData($data->id, $data->date_appointment, $data->flag);
            // $responseData = json_encode($viewAppointment);
            $responseData = json_encode($this->formateDate($viewAppointment));
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
    public function historyAction()
    {
        $strErrorDesc = '';
        $appointmentModel = new AppointmentModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $viewAppointment = $appointmentModel->getAppointmentHistory($data->id, $data->date_appointment);

            $responseData = json_encode($this->formateDate($viewAppointment));
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


    function formateDate($dateArray)
    {
        if (!is_array($dateArray)) {
            $dateString = $dateArray;
            $format = "d/m/Y H:i:s";
            $formattedDate = date($format, strtotime($dateString));
            return $formattedDate;
        }
    
        for ($i = 0; $i < count($dateArray); $i++) {
            $dateString = $dateArray[$i]["date_appointment"];
            $format = "d/m/Y H:i:s";
            $formattedDate = date($format, strtotime($dateString));
            $dateArray[$i]["date_appointment"] = $formattedDate;
        }
        return $dateArray;
    }

    public function findByIdAction()
    {
        $strErrorDesc = '';
        $appointmentModel = new AppointmentModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            $id = Utils::REQUEST_ID();
            $appointment = $appointmentModel->find_appointment_ById($id);
            $responseData = json_encode($appointment);

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
        $appointmentModel = new AppointmentModel();
        $validations = new AppointmentValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'DELETE') {
            $id = Utils::REQUEST_ID();
            if (
                $appointmentModel->isAppointmentsExist($id) &&
                $validations->isInteger($id)[0]
            ) {
                $appointmentModel->deleteAppointment($id);
                echo json_encode(array("message" => "El registro se elimino"));
            } else {
                echo json_encode(array("message" => "El registro no existe"));
            }
        }
    }

    public function changeAssistanceAction()
    {
        $appointmentModel = new AppointmentModel();
        $validations = new AppointmentValidations();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'PUT') {
            $id = Utils::REQUEST_ID();
            if (
                $appointmentModel->isAppointmentsExist($id) &&
                $validations->isInteger($id)[0]
            ) {
                $appointmentModel->change_assistance($id);
            } else {
                echo "no existe";
            }
        }
    }

    public function TomorrowAction()
    {
        $appointmentModel = new AppointmentModel();
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $arrAppoint = $appointmentModel->getAppointmentTomorrow();
                $responseData = json_encode($arrAppoint);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
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
}
