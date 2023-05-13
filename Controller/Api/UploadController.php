<?php

require_once "./Utils/Utils.url.php";
class UploadController
{
    function uploadimageAction()
    {

        $max_filesize = 1000000; // 1 MB

        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            $httpPost = file_get_contents("php://input");
            $req = json_decode($httpPost);
            $userFolder = $req->cedula;

            $url_insert = dirname("../") . "/uploadFolder/" . $userFolder . "/"; //
            if (!file_exists($url_insert)) {
                mkdir($url_insert, 0777, true);
            };

            $file_chunks = explode(";base64,", $req->image);
            $fileType = explode("image/", $file_chunks[0]);
            $image_type = $fileType[1];
            $base64Img = base64_decode($file_chunks[1]);
            $file =  "uploadFolder/" . $userFolder . "/" . uniqid() .".". $image_type;

            if (!$this->validateImageSize($base64Img, $max_filesize)) {
                echo json_encode(array("Message" => "El archivo es muy grande , no puede ser superior a 1mb."));
            } else {
                file_put_contents($file, $base64Img);
                if (file_exists($file)) {

                    echo json_encode(array("Message" => "El archivo se guardó exitosamente"));
                };
            }
        }
    }

    function getImageAction()
    {
        $path = "uploadFolder/11573550050/63c10061d8f40.png";
        $imagedata = file_get_contents($path);
        $base64 = base64_encode($imagedata);

        echo $base64;
    }


    // funcion llamada para validar tamaño de imagen setear $max_filesize = 2 * 1024 * 1024;
    function validateImageSize($base64Img, $max_filesize)
    {
        if (strlen($base64Img) > $max_filesize) {
            return false;
        } else {
            return true;
        }
    }

    //-------------------------- linux --------------------------
    // function upload_imageAction($user)
    // {
    //     $max_filesize = 1 * 1024 * 1024; // 2 MB

    //     $requestMethod = $_SERVER["REQUEST_METHOD"];
    //     if (strtoupper($requestMethod) == 'POST') {
    //         $DIR = "/home/gestion04/server-images/" . $user . "/";
    //         if (!file_exists($DIR)) {
    //             mkdir($DIR, 0777, true);
    //         };
    //         $httpPost = file_get_contents("php://input");
    //         $req = json_decode($httpPost);

    //         $file_chunks = explode(";base64,", $req->image);

    //         $fileType = explode("image/", $file_chunks[0]);

    //         $image_type = $fileType[1];

    //         $base64Img = base64_decode($file_chunks[1]);

    //         $file = $DIR . uniqid() . '.png';

    //         if(!validateImageSize($base64Img, $max_filesize)) {
    //             echo "Error: The file is too large. Maximum file size is 2MB.";
    //         } else {
    //         file_put_contents($file, $base64Img);
    //     }
    // }

    // function get_ImageAction()
    // {
    //     $path = "uploadFolder/11573550050/63c10061d8f40.png";
    //     $imagedata = file_get_contents($path);
    //     // alternatively specify an URL, if PHP settings allow
    //     $base64 = base64_encode($imagedata);

    //     echo $base64;
    // }
}
