<?php
require "core/DBMySQL.php";
require "core/Validator.php";

class Controller
{
    function render($v, $d = null)
    {
        include "View.php";
        $view = new View();
        if (!empty($d)) extract($d);
        include "./src/views/$v.php";
    }

    function log()
    {
        $logger = new Katzgrau\KLogger\Logger(__DIR__  . '/logs/errors');
        $logger->info('Returned a million search results');
    }

    function logMySQl($log)
    {
        if ($log !== "SET NAMES utf8") {
            $logger = new Katzgrau\KLogger\Logger(__DIR__  . '/logs/mysql');
            $logger->info($log);
        }
    }

    function addDays($x,$d = null) {
        $date = ($d) ? $d : date("Y-m-d");
        $data = date('Y-m-d',strtotime($date . ' + ' . $x . ' days'));
        return $data;
    }

    function redirect($url)
    {
        return header('Location: ' . $url);
    }

    function session($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return false;
    }

    function setSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }
        return false;
    }

    function post($name)
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }

        return false;
    }

    function copyFromPost()
    {
        $array = [];
        foreach ($_POST as $key => $value) {
            if (!empty($value)) {
                $array[$key] = $value;
            }
        }

        return $array;
    }

    function get($name)
    {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }

        return false;
    }

    function mysql()
    {
        $db = new DBMySQL();
        return $db;
    }

    function validator()
    {
        $v = new Validator();
        return $v;
    }

    function ini($name)
    {
        $ini_array = parse_ini_file("./config.ini");
        return ($ini_array[$name]);
    }

    function sc($i)
    {
        $ini_array = parse_ini_file("./sc/$i.ini");
        return ($ini_array);
    }

    function pre($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    function converteDinheiro($value = null)
    {

        if ($value) {
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
            return $value;
        }
    }

    function previous()
    {
        // previus url
        $url = $_SERVER['HTTP_REFERER'];
        return $url;
    }

    public static function enviaNotificacaoWP($numero, $message)
    {

        $numero = preg_replace("/[^0-9]/", "", $numero);
        //remove first caracter from numero

        //if the fourth caracter is a 9 or 8, remove it
        if (substr($numero, 3, 1) == 9 || substr($numero, 3, 1) == 8) {
            $numero = substr_replace($numero, '', 2, 1);
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ultramsg.com/instance6229/messages/chat",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "token=q0utkx9jkeddvkoo&to=+55$numero&body=$message&priority=1&referenceId=",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        /*if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }*/
    }

    public function salvaStream($data = [])
    {
        $this->mysql()->insert('stream', $data);
    }


    public function requireAdmin()
    {
        if ($this->session('regra') != 1) {
            return $this->redirect('/main/stream');
        }
    }

    public function requireLogin()
    {   
        
        if (!$this->session('id')) {
            return $this->redirect('/main/login');
        }
    }
}
