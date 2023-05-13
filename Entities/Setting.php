<?php
class Setting
{
    public  $id_setting;
    public $email;
    public $phone_number;
    

    function __construct()
    {
        $params = func_get_args();
        $num_params = func_num_args();
        $funcion_constructor = '__construct' . $num_params;

        if (method_exists($this, $funcion_constructor)) {
            call_user_func_array(array($this, $funcion_constructor), $params);
        }
    }

    function __construct3($id_setting,$email, $phone_number)
    {
        $this->id_setting = $id_setting;
        $this->email = $email;
        $this->phone_number = $phone_number;

    }

    function __construct2( $email, $phone_number)
    {
        $this->email = $email;
        $this->phone_number = $phone_number;
    }

}
