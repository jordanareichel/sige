<?php

class Base
{

    function error()
    {
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        error_reporting(E_ALL);
    }

    

    function run()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('/', $url);
        $route = ($url[1]) ? ucfirst($url[1]) : 'Main';
        $action = (isset($url[2])) ? $url[2] : 'index';
        $nmethod = strstr($action, '?', true);
        if ($nmethod) {
            $action = $nmethod;
        }
        require "./src/controllers/$route.php";
        $c = new $route;
        $c->$action();
    }

    function ini($name)
    {
        $ini_array = parse_ini_file("./config.ini");
        return ($ini_array[$name]);
    }

    
}
