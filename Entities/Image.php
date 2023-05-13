<?php

class Image{

    public $id_image;

    public $id_user;

    public $image_path;


    function __construct()
    {
        $params = func_get_args();
        $num_params = func_num_args();
        $funcion_constructor = '__construct' . $num_params;
        if (method_exists($this, $funcion_constructor)) {
            call_user_func_array(array($this, $funcion_constructor), $params);
        }
    }

    function __construct2($id_user, $image_path)
    {
        $this->id_user = $id_user;
        $this->image_path = $image_path;
    }

    function __construct3($id_image, $id_user, $image_path)
    {
        $this->id_image = $id_image;
        $this->id_user = $id_user;
        $this->image_path = $image_path;
    }


}