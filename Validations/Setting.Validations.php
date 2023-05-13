<?php

require_once './Entities/Setting.php';
require_once './Validations/Validations.php';
class SettingValidations extends Validations
{


    public function validateUpdate(Setting $setting)
    {
        $errors = array();
        $bool = array();


        if (!$this->validateEmail($setting->email)[0]) {
            array_push($errors, $this->validateEmail($setting->email)[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        
        if (!$this->isPhoneNumber($setting->phone_number, "phone_number")[0]) {
            array_push($errors, $this->isInteger($setting->phone_number, "phone_number")[1]);
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

    public function validateCreate(Setting $setting){
        $errors = array();
        $bool = array();




        if (!$this->validateEmail($setting->email)[0]) {
            array_push($errors, $this->validateEmail($setting->email)[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->isPhoneNumber($setting->phone_number, "phone_number")[0]) {
            array_push($errors, $this->isPhoneNumber($setting->phone_number, "phone_number")[1]);
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
