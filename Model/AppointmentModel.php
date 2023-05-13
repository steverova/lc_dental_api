<?php
require_once "./Utils/Procedure.php";
require_once "./Model/Database.php";
require_once "./Utils/Utils.url.php";
class AppointmentModel extends Database
{

    public function createAppointment($data)
    {
        return $this->executeAction(Procedure::$sp_appointments_create, ["iss", Utils::ObjectToArray($data)]);
    }

    public function updateAppointment($data)
    {
        $array = Utils::ObjectToArray($data);
        return $this->executeAction(Procedure::$sp_appointments_update, ["iss", $array]);
    }

    public function getAppointmentData($id, $date_appointment, $flag)
    {
        return $this->select(Procedure::$sp_appointments_find_data, ["isi", [$id, $date_appointment, $flag]]);
    }

    public function getAppointmentHistory($id, $date_appointment)
    {
        return $this->select(Procedure::$sp_appointments_history, ["is", [$id, $date_appointment]]);
    }

    public function deleteAppointment($id)
    {
        echo ("fabiannnn");
        return $this->executeAction(Procedure::$sp_appointments_delete, ["i", [$id]]);
    }
    public function find_appointment_ById($id)
    {
        return $this->select(Procedure::$sp_appointments_findbyid, ["i", [$id]]);
    }


    public function change_assistance($id)
    {
        return $this->executeAction(Procedure::$sp_appointment_change_assistance, ["i", [$id]]);
    }

    public function isAppointmentsExist($id)
    {
        var_dump($id);
        $appointment = $this->select(Procedure::$sp_appointments_exist, ["i", [$id]]);
        $responseData = json_encode($appointment);
        $result =  json_decode($responseData);
        return $result[0]->result;
    }

    public function getAppointmentbyLasMonth($id)
    {

        return $this->select(Procedure::$sp_appointments_patient_lastAppointment_bymonth, ["i", [$id]]);
    }

    public function getAppointmentOfDay()
    {

        return $this->select(Procedure::$sp_appointments_get_today);
    }

    public function getAppointmentTomorrow()
    {

        return $this->select(Procedure::$sp_appointments_getNextDay);
    }
}
