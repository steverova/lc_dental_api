<?php

require_once './Entities/Patient.php';
require_once './Validations/Validations.php';
class PatientValidations extends Validations
{

    public function validateUpdate(Patient $patient)
    {
        $errors = array();
        $bool = array();

        if (!$this->isInteger($patient->id_user, "id_user")[0]) {
            array_push($errors, $this->isInteger($patient->id_user, "id_user")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->valid_id($patient->id_card, "id_card")[0]) {
            array_push($errors, $this->valid_id($patient->id_card, "id_card")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->onlyLetters($patient->name, "name")[0]) {
            array_push($errors, $this->onlyLetters($patient->name, "name")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->onlyLetters($patient->last_name, "last_name")[0]) {
            array_push($errors, $this->onlyLetters($patient->last_name, "last_name")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }

        if (!$this->validateEmail($patient->email)[0]) {
            array_push($errors, $this->validateEmail($patient->email)[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->onlyLetters($patient->payer, "payer")[0]) {
            array_push($errors, $this->onlyLetters($patient->payer, "payer")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        
        if (!$this->isPhoneNumber($patient->phone_number, "phone_number")[0]) {
            array_push($errors, $this->isInteger($patient->phone_number, "phone_number")[1]);
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

    public function validateCreate(Patient $patient){
        $errors = array();
        $bool = array();


        if (!$this->valid_id($patient->id_card, "id_card")[0]) {
            array_push($errors, $this->valid_id($patient->id_card, "id_card")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->onlyLetters($patient->name, "name")[0]) {
            array_push($errors, $this->onlyLetters($patient->name, "name")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->onlyLetters($patient->last_name, "last_name")[0]) {
            array_push($errors, $this->onlyLetters($patient->last_name, "last_name")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }

        if (!$this->validateEmail($patient->email)[0]) {
            array_push($errors, $this->validateEmail($patient->email)[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->onlyLetters($patient->payer, "payer")[0]) {
            array_push($errors, $this->onlyLetters($patient->payer, "payer")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        
        if (!$this->isPhoneNumber($patient->phone_number, "phone_number")[0]) {
            array_push($errors, $this->isPhoneNumber($patient->phone_number, "phone_number")[1]);
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
