<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');
header('Content-Type: aplication/json');
date_default_timezone_set("America/Costa_Rica");
require_once "./Controller/Api/jwt.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === "/api/") {
    echo "index";
} else {
    $uri = explode('/', $uri);
    $controller_name = $uri[2] . "Controller";
    $method_name = $uri[3] . 'Action';
    require_once "./inc/bootstrap.php";

    $route = "";

    $route = "./Controller/Api/" . ucfirst($controller_name) . ".php";
    require_once "./Controller/Api/" . ucfirst($controller_name) . ".php";

    $exist = is_file($route);
    if ($exist) {
        if (class_exists($controller_name) && method_exists($controller_name, $method_name)) {
            $controller = new $controller_name;
            $controller->{$method_name}();
        }
    } else {
        echo  json_encode(array("ERROR" => "RUTA NO ENCONTRADA"));
    }
}
