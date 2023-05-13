<?php
require_once "./Utils/Procedure.php";
require_once "./Model/Database.php";
require_once "./Utils/Utils.url.php";
class SettingModel extends Database
{

    public function createSetting($data)
    {
        return $this->executeAction(Procedure::$sp_settings_create, ["ss", Utils::ObjectToArray($data)]);
    }

    public function updateSetting($data)
    {
        return $this->executeAction(Procedure::$sp_settings_update, ["iss", Utils::ObjectToArray($data)]);
    }

    public function getSettingById($option)
    {
        return $this->select(Procedure::$sp_settings_findbyid, ["i", [$option]]);
    } 

    public function getAllSetting()
    {
        return $this->select(Procedure::$sp_settings_getData);
    }

    public function deleteSetting($id)
    {
        return $this->executeAction(Procedure::$sp_setting_delete, ["i", [$id]]);
    }



    public function issettngExist($id)
    {
        $settng = $this->select(Procedure::$sp_settings_exist, ["i", [$id]]);
        $responseData = json_encode($settng);
        $result =  json_decode($responseData);
        return $result[0]->result;
    }
}
