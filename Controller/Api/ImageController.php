<?php

use LDAP\Result;

require_once "./Entities/Image.php";
require_once "./Model/ImageModel.php";

class ImageController extends BaseController
{
    function createAction()
    {

        $imageModel = new ImageModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $image = new Image(
                $data->id_user,
                $data->image,
            );

            $result =  $imageModel->createImage($image);
            if ($result) {
                echo json_encode(array("Message" => "El archivo se guardó exitosamente"));
            }
        }
    }

    public function listAction()
    {
        $strErrorDesc = '';
        $imageModel = new ImageModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {

            $id = Utils::REQUEST_ID();

            $imageREsult = $imageModel->listImageByIdPatient($id);
            $responseData = json_encode($imageREsult);
            if (json_decode($responseData, true)) {
                $this->sendOutput(
                    $responseData,
                    array('Content-Type: application/json', 'HTTP/1.1 200 OK')
                );
            } else {
                echo json_encode(array("message" => "No contiene imagenes", "status" => 0));
            }
        }
    }
    public function deleteAction()
    {
        $imageModel = new ImageModel();
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'DELETE') {
            $id = Utils::REQUEST_ID();

            if (
                $imageModel->isImagesExist($id)
            ) {
                $imageModel->deleteImage($id);
                //var_dump($return);
                return json_encode(array("message:" => "Registro actualizado"));
            } else {
                return json_encode(array("message:" => "El usuario no existe"));
            }
        }
    }



}
