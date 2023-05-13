<?php
require_once "./Entities/Note.php";
require_once "./Model/NoteModel.php";
require_once './Validations/Validations.php';

class NoteController extends BaseController
{
    // Metodo de creacion para añadir pacientes 

    function createAction()
    {
        $noteModel = new NoteModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'POST') {
            $result = false;
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $note = new Note(
                $data->description,
            );
                $result = $noteModel->createNote($note);
                $result->close();
            }
        }
    


    public function deleteAction()
    {
        $noteMol = new NoteModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'DELETE') {
            $id = Utils::REQUEST_ID();
            if (
                $noteMol->noteIsExist($id)
            ) {
                $noteMol->deleteNote($id);
                echo json_encode(array("message" => "El registro se elimino"));
            } else {
                echo json_encode(array("message" => "El registro no existe"));
            }
        }
    }

    public function changeDoneAction()
    {
        $noteMol = new NoteModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'PUT') {
            $id = Utils::REQUEST_ID();
            if ($noteMol->noteIsExist($id))
                {
                $noteMol->change_done($id);
            } else {
                echo "no existe";
            }
        }
    }

    public function listAction()
    {
        $noteMod = new NoteModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            $viewNotes = $noteMod->getAllNote();
            $responseData = json_encode($viewNotes);
            if (json_decode($responseData, true)) {
                $this->sendOutput(
                    $responseData,
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                );
            } else {
                $strErrorDesc = 'Not found data for this record';
                $strErrorHeader = 'HTTP/1.1 204 No Content';
                $this->sendOutput(
                    json_encode(array('error' => $strErrorDesc)),
                    array(
                        'Content-Type: application/json',
                        $strErrorHeader
                    )
                );
            }
        }
    }

}