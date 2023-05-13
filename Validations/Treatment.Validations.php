
<?php

require_once './Validations/Validations.php';

class TreatmentValidations extends Validations
{

    function isValueEmpty($data)
    {

        $errors = array();
        $bool = array();

        // var_dump($data);

        if ($this->isEmpty($data->name, "name")[0]) {
           
            array_push($errors, $this->isEmpty($data->name, "name")[1]);
            array_push($bool, true);
        } else {
            
            array_push($bool, false);
        }

        // if ($this->isEmpty($data->description, "description")[0]) {
        //     array_push($errors, $this->isEmpty($data->description, "description")[1]);
        //     array_push($bool, true);
        // } else {
        //     array_push($bool, false);
        // }

        if ($this->isEmpty($data->image, "image")[0]) {
            array_push($errors, $this->isEmpty($data->image, "image")[1]);
            array_push($bool, true);
        } else {
            array_push($bool, false);
        }

        if (in_array(true, $bool)) {
            return [true, json_encode($errors)];
        } else {
            return [false];
        }
    }
}
