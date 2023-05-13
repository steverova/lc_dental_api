<?php
class Patient
{
    public  $id_user;
    public $id_card;
    public $name;
    public $last_name;
    public $email;
    public $phone_number;
    public $location;
    public $payer;
    public $comments;
    

    function __construct()
    {
        $params = func_get_args();
        $num_params = func_num_args();
        $funcion_constructor = '__construct' . $num_params;

        if (method_exists($this, $funcion_constructor)) {
            call_user_func_array(array($this, $funcion_constructor), $params);
        }
    }

    function __construct9($id_user, $id_card, $name, $last_name, $email, $phone_number, $location, $payer, $comments)
    {
        $this->id_user = $id_user;
        $this->id_card = $id_card;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->location = $location;
        $this->payer = $payer;
        $this->comments = $comments;
    }

    function __construct8($id_card, $name, $last_name, $email, $phone_number, $location, $payer, $comments)
    {
        $this->id_card = $id_card;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->location = $location;
        $this->payer = $payer;
        $this->comments = $comments;
    }

    public function getphone_number()
    {
        return $this->phone_number;
    }

    public function setphone_number($phone_number)
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getId_user()
    {
        return $this->id_user;
    }

    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }
    public function getId_card()
    {
        return $this->id_card;
    }
    public function setId_card($id_card)
    {
        $this->id_card = $id_card;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getLast_name()
    {
        return $this->last_name;
    }

    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    public function getPayer()
    {
        return $this->payer;
    }

    public function setPayer($payer)
    {
        $this->payer = $payer;

        return $this;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }
}
