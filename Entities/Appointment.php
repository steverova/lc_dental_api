<?php
class Appointment
{
    public $id;
    public $id_patient;
    public $date_appointment;
    public $reason;

    public $assistance;

    function __construct()
    {
        $params = func_get_args();
        $num_params = func_num_args();
        $funcion_constructor = '__construct' . $num_params;

        if (method_exists($this, $funcion_constructor)) {
            call_user_func_array(array($this, $funcion_constructor), $params);
        }
    }

    function __construct5($id, $id_patient, $date_appointment, $reason, $assistance)
    {
        $this->id = $id;
        $this->id_patient = $id_patient;
        $this->date_appointment = $date_appointment;
        $this->reason = $reason;
        $this->assistance = $assistance;
    }



    function __construct3($id_patient, $date_appointment, $reason)
    {
        $this->id_patient = $id_patient;
        $this->date_appointment = $date_appointment;
        $this->reason = $reason;
    }

    function paramstoUpdate($id, $date_appointment, $reason){
        $this->id = $id;
        $this->date_appointment = $date_appointment;
        $this->reason = $reason;
    }
}
