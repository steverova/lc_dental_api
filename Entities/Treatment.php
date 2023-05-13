<?php
class Treatment
{
    public $id_treatment;
    public $name;
    public $description;
    public $image;

    function __construct()
    {
        $params = func_get_args();
        $num_params = func_num_args();
        $funcion_constructor = '__construct' . $num_params;
        if (method_exists($this, $funcion_constructor)) {
            call_user_func_array(array($this, $funcion_constructor), $params);
        }
    }

    function __construct4($id_treatment, $name, $description, $image)
    {
        $this->id_treatment = $id_treatment;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }

    function __construct3($name, $description, $image)
    {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }
}
