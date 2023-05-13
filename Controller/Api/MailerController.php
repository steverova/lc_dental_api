<?php

require_once "./Model/MailerModel.php";
require_once "./Validations/Validations.php";
require_once "./Model/AppointmentModel.php";
class MailerController extends MailerModel
{
    function mailerAction()
    {
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $validations = new Validations();

        if (strtoupper($requestMethod) == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);

            if ($validations->validateEmail($data->receiver)[0]) {
                $this->sendMail($data->receiver, $data->message, $data->subject);
            } else {
                echo json_encode($validations->validateEmail($data->receiver)[1]);
            }
        }
    }

    function sendAlertAction()
    {

        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            $appointmentModel = new AppointmentModel();
            $arrAppoint = $appointmentModel->getAppointmentTomorrow();
            $data = json_decode(json_encode($arrAppoint));
            $len =  count($arrAppoint);

            for ($i = 0; $i < $len; $i++) {
                $message = $this->createMessage($data[$i]);
                $this->sendMail($data[$i]->email, $message, "Recordatorio de cita");
            }

            echo json_encode(array("message" => "Se han enviado ". $len . " notificaciones exitosamente", "Status" => true));
        }
    }

    function createMessage($data)
    {

        $message = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
        <div style="padding: 20px">
          <div style="width: 400px; height: 200px" class="card border-dark mb-3" style="max-width: 20rem;">
            <div class="card-header">Recordatorio de cita</div>
            <div class="card-body">
              <h4 class="card-title">LC DENTAL</h4>
              <p class="card-text">Buenas, ' . $data->name . ' ' . $data->last_name . ', de parte de LC DENTAL se le recuerda que tiene una cita agendada el día ' . explode(" ", $data->date_appointment)[0] . ' a las ' . explode(" ", $data->date_appointment)[1] . ', por favor, presentarse 15 minutos antes.</p>
            </div>
          </div>
        </div>';

        return $message;
    }
}
