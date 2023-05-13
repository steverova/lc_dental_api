<?php
require_once "./Utils/Procedure.php";
require_once "./Model/Database.php";
require_once "./Utils/Utils.url.php";
class LoginModel extends Database
{

    public function register($user)
    {
        return $this->executeAction(Procedure::$sp_users_login_create, ["sssssis", Utils::ObjectToArray($user)]);

    }

    public function generateConfirmCode($user)
    {
        return $this->executeAction(Procedure::$sp_generated_code, ["is", Utils::ObjectToArray($user)]);

    }
    public function confirmCode($id_user, $code)
    {
        return $this->select(Procedure::$sp_confirm_code, ["is", [$id_user, $code]]);

    }
    public function activeUser($id_user)
    {
        return $this->executeAction(Procedure::$sp_active_user, ["i", [$id_user]]);

    }

    public function loginUser($user)
    {
        return $this->select(Procedure::$sp_login_user, ["ss",    [$user->username,
        $user->password]]);

    }
    
    public function getUserByUsernameOrEmail($username)
    {
        return $this->select(Procedure::$sp_get_user_by_username_or_email, ["s", [$username]]);

    }

    public function updateUser($user)
    {
        return $this->executeAction(Procedure::$sp_users_login_update, ["sssssi", Utils::ObjectToArray($user)]);
        
    }

}
