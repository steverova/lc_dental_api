<?php
class Note
{
    public $id_note;
    public $description;
    public $done;

    function __construct()
    {
        $params = func_get_args();
        $num_params = func_num_args();
        $funcion_constructor = '__construct' . $num_params;

        if (method_exists($this, $funcion_constructor)) {
            call_user_func_array(array($this, $funcion_constructor), $params);
        }
    }

    function __construct3($id_note, $description, $done,)
    {
        $this->id_note = $id_note;
        $this->description = $description;
        $this->done = $done;
    }

    function __construct1($description)
    {
        $this->description = $description;
    }
}
