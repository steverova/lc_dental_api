<?php
class Utils
{
    public static function REQUEST_ID()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);
        $id = end($uri);
        return $id;
    }

    public static function REQUEST_URI_PARAMS($split)
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode("/", $uri);
        $params = end($uri);
        $params = explode("=", $params);
        return $params;
    }

    public static function console_log($output, $with_script_tags = true)
    {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
            ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }

    //toma un objeto key => value y los transforma en un array 
    public static function ObjectToArray($data)
    {

        $array = (array) $data;
        $array = array_filter($array);
        foreach ($array as $key => $value) {
            $arr[] =  $value;
        }
        return $arr;
    }
}
