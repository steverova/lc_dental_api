 <?php
    class User
    {
        public $id_user;
        public $name;
        public $last_name;
        public $user_name;
        public $password;
        public $email;
        public $status;
        public $created_date;
        public $code;


        function __construct()
        {
            $params = func_get_args();
            $num_params = func_num_args();
            $funcion_constructor = '__construct' . $num_params;

            if (method_exists($this, $funcion_constructor)) {
                call_user_func_array(array($this, $funcion_constructor), $params);
            }
        }

        function register($name, $last_name, $user_name, $password, $email, $status, $created_date)
        {
            $this->name = $name;
            $this->last_name = $last_name;
            $this->user_name = $user_name;
            $this->password = $password;
            $this->email = $email;
            $this->status = $status;
            $this->created_date = $created_date;
        }

        function login($user_name, $password)
        {
            $this->user_name = $user_name;
            $this->password = $password;
        }

        function generateCode($id_user, $code)
        {
            $this->id_user = $id_user;
            $this->code = $code;
        }

    }
