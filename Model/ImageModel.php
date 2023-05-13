<?php
require_once "./Utils/Procedure.php";
require_once "./Model/Database.php";
require_once "./Utils/Utils.url.php";
class ImagEModel extends Database
{

    public function createImage($data)
    {
        $stmt = $this->executeAction(Procedure::$sp_images_create, ["is", Utils::ObjectToArray($data)]);

        return $stmt;
    }

    public function listImageByIdPatient($id_patient)
    {
        return $this->select(Procedure::$sp_images_getbyid, ["i", [$id_patient]]);
    }

    public function deleteImage($id)
    {
        return $this->executeAction(Procedure::$sp_images_delete, ["i", [$id]]);
    }
    public function isImagesExist($id)
    {
        $image = $this->select(Procedure::$sp_images_exist, ["i", [$id]]);
        $responseData = json_encode($image);
        $result =  json_decode($responseData);
        return $result[0]->result;
    }

}
