<?php
require_once "./Utils/Procedure.php";
require_once "./Model/Database.php";
require_once "./Utils/Utils.url.php";
class PatientModel extends Database
{

    public function createPatient($data)
    {
        return $this->executeAction(Procedure::$sp_patients_create, ["isssssss", Utils::ObjectToArray($data)]);
    }

    public function updatePatient($data)
    {
        return $this->executeAction(Procedure::$sp_patients_update, ["issssssss", Utils::ObjectToArray($data)]);
    }

    public function getByOptions($option)
    {
        return $this->select(Procedure::$sp_patients_getByOption, ["i", [$option]]);
    } 

    public function getPatients($limit)
    {
        return $this->select(Procedure::$sp_patients_getByLimit, ["i", [$limit]]);
    }

    public function getAllPatients()
    {
        return $this->select(Procedure::$sp_patients_getAll);
    }

    public function findById($id_user)
    {
        return $this->select(Procedure::$sp_patient_findById, ["i", [$id_user]]);
    }

    public function deletePatient($id_user)
    {
        return $this->executeAction(Procedure::$sp_patients_status, ["i", [$id_user]]);
    }

    public function searchPatient($param)
    {
        return $this->select(Procedure::$sp_patients_search, ["s", [$param]]);
    }

    public function isPatientsExist($id_user)
    {
        $patient = $this->select(Procedure::$sp_patients_exist, ["i", [$id_user]]);
        $responseData = json_encode($patient);
        $result =  json_decode($responseData);
        return $result[0]->result;
    }

    public function isIdExist($id_card)
    {
        {
            $patient = $this->select(Procedure::$sp_patient_validate_id_card, ["i", [$id_card]]);

            $responseData = json_encode($patient);
            $result =  json_decode($responseData);

            return $result[0]->result;

        }
    }
    


    public function isEmailExist($email)
    {
        {
            $patient =  $this->select(Procedure::$sp_patient_validate_email, ["s", [$email]]);
            $responseData = json_encode($patient);
            $result =  json_decode($responseData);

            return $result[0]->result;
        }
    }
}
