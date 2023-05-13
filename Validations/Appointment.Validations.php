<?php

require_once './Entities/Appointment.php';
require_once './Validations/Validations.php';
class AppointmentValidations extends Validations
{


    public function validateCreate(Appointment $appointment){
        $errors = array();
        $bool = array();


        if (!$this->isInteger($appointment->id_patient, "id_patient")[0]) {
            array_push($errors, $this->isInteger($appointment->id_patient, "id_card")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }

        if (in_array(false, $bool)) {
            return [false, json_encode($errors)];
        } else {
            return [true];

        }
    }
    public function validateUpdate(Appointment $appointment){
        $errors = array();
        $bool = array();


        if (!$this->isInteger($appointment->id, "id")[0]) {
            array_push($errors, $this->isInteger($appointment->id_patient, "id")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }

        if (in_array(false, $bool)) {
            return [false, json_encode($errors)];
        } else {
            return [true];

        }
    }
}
