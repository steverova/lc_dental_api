<?php

class Validations
{

    public function onlyLetters($data, $name_value)
    {

        if (!preg_match('/^[aA-zZñÑ\x{00C0}-\x{017F}]+$/u', $data)) {
            return [false, array("message" => "record " . $name_value . " only accepts letters")];
        } else {
            return [true];
        }
    }

    public function validateEmail($data)
    {
        if (filter_var($data, FILTER_VALIDATE_EMAIL) === false) {
            $err = "Email format invalid";
            return [false, array("Error Format: " => $err)];
        } else {
            return [true];
        }
    }

    public function isInteger($number, $name_value = "")
    {
        if (filter_var($number, FILTER_VALIDATE_INT) === false) {
            return [false, "record " . $name_value . " only accepts integers values"];
        } else {
            return [true];
        }
    }

    public function valid_id($id_card, $name_value)
    {

        if ($this->isInteger($id_card, $name_value) && strlen($id_card) <= 9 && strlen($id_card) >= 9) {

            return [true];
        } else {
            return [false, "record " . $name_value . " only accepts integers values and length 9 digit"];
        };
    }

    public function isPhoneNumber($number, $name_value = "")
    {
        if (
            (filter_var($number, FILTER_VALIDATE_INT)) && ((strlen($number) <= 8 && strlen($number) >= 8) && ((preg_match("/^[1-9]\d*$/", $number))))
        ) {
            return [true];
        } else {

            return [false, array("message" => "record " . $name_value . " error in format number")];
        }
    }

    public function isDate($date, $name_value)
    {
        $dateTem = explode('-', $date);
        var_dump($dateTem);
        if (checkdate($dateTem[0], $dateTem[1], $dateTem[2])) {
            return [true];
        } else {
            return [false, array("message" => "record " . $name_value . " error in format date ")];
        }
    }

    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        if ($d && $d->format($format) === $date) {
            return [true];
        } else {
            return [false, array("message" => "record error in format date ")];
        }
    }

    function isEmpty($param, $nameParam){

        if (empty($param)) {
            return [true, array("message" => "The record ".$nameParam." must not be null")];
        } else {
            return [false];
        }

    }
}
