<?php
require_once "./Utils/Procedure.php";
require_once "./Model/Database.php";
require_once "./Utils/Utils.url.php";
class TreatmentModel extends Database
{

    public function create($data)
    {
        return $this->executeAction(Procedure::$sp_treatments_insert, ["sss", [
            $data->name,
            $data->description,
            $data->image
        ]]);
    }
    public function update($data)
    {
        return $this->executeAction(Procedure::$sp_treatments_update, ["isss", Utils::ObjectToArray($data)]);
    }
    public function delete($data)
    {
        return $this->executeAction(Procedure::$sp_treatments_delete, ["i", [$data]]);
    }
    public function getAll()
    {
        return $this->select(Procedure::$sp_treatments_select);
    }
    public function findById($data)
    {
        return $this->select(Procedure::$sp_treatments_getbyid, ["i", Utils::ObjectToArray($data)]);
    }

    public function isExists($id)
    {
        $result =  $this->select(Procedure::$sp_treatments_exist, ["i", [$id]]);
        $result = $result[0]["result"];
        return $result;
    }
}
