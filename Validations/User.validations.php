<?php

require_once './Entities/User.php';
require_once './Validations/Validations.php';
class UserValidations extends Validations
{

    public function validateUpdate(User $user)
    {
        $errors = array();
        $bool = array();

        if (!$this->onlyLetters($user->name, "name")[0]) {
            array_push($errors, $this->onlyLetters($user->name, "name")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->onlyLetters($user->last_name, "last_name")[0]) {
            array_push($errors, $this->onlyLetters($user->last_name, "last_name")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->isEmpty($user->user_name, "user_name")[0]) {
            array_push($errors, $this->onlyLetters($user->user_name, "user_name")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->isEmpty($user->password, "password")[0]) {
            array_push($errors, $this->onlyLetters($user->password, "password")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->validateEmail($user->email)[0]) {
            array_push($errors, $this->validateEmail($user->email)[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->isInteger($user->id_user)[0]) {
            array_push($errors, $this->validateEmail($user->id_user)[1]);
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

    public function validateCreate(User $user)
    {
        $errors = array();
        $bool = array();

        if (!$this->onlyLetters($user->name, "name")[0]) {
            array_push($errors, $this->onlyLetters($user->name, "name")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->onlyLetters($user->last_name, "last_name")[0]) {
            array_push($errors, $this->onlyLetters($user->last_name, "last_name")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->isEmpty($user->user_name, "user_name")[0]) {
            array_push($errors, $this->isEmpty($user->user_name, "user_name")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->isEmpty($user->password, "password")[0]) {
            array_push($errors, $this->isEmpty($user->password, "password")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->validateEmail($user->email)[0]) {
            array_push($errors, $this->validateEmail($user->email)[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->isInteger($user->status, "status")[0]) {
            array_push($errors, $this->isInteger($user->status, "status")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->isDate($user->created_date, "created_date")[0]) {
            array_push($errors, $this->isDate($user->created_date, "created_date")[1]);
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

    public function validateCode($user){

        $errors = array();
        $bool = array();

        if (!$this->isInteger($user->id_user, "id_user")[0]) {
            array_push($errors, $this->isInteger($user->id_user, "id_user")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->isEmpty($user->code, "code")[0]) {
            array_push($errors, $this->isEmpty($user->code, "code")[1]);
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

    public function validateLogin($user){
        if (!$this->isEmpty($user->user_name, "user_name")[0]) {
            array_push($errors, $this->isEmpty($user->user_name, "user_name")[1]);
            array_push($bool, false);
        } else {
            array_push($bool, true);
        }
        if (!$this->isEmpty($user->paswword, "paswword")[0]) {
            array_push($errors, $this->isEmpty($user->paswword, "paswword")[1]);
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
