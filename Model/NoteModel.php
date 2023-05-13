<?php
require_once "./Utils/Procedure.php";
require_once "./Model/Database.php";
require_once "./Utils/Utils.url.php";
class NoteModel extends Database
{

    public function createNote($data)
    {
        return $this->executeAction(Procedure::$sp_note_create, ["s", Utils::ObjectToArray($data)]);
    }


    public function getAllNote()
    {
        return $this->select(Procedure::$sp_note_getAll);
    }

    public function change_done($id)
    {
        return $this->executeAction(Procedure::$sp_note_change_done, ["i", [$id]]);
    }


    public function deleteNote($id)
    {
        return $this->executeAction(Procedure::$sp_note_delete, ["i", [$id]]);
    }



    public function noteIsExist($id)
    {
        $settng = $this->select(Procedure::$sp_note_exist, ["i", [$id]]);
        $responseData = json_encode($settng);
        $result =  json_decode($responseData);
        return $result[0]->result;
    }
}
