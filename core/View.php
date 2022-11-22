<?php

class View extends Controller
{
    function partial($name, $data = [])
    {
        $view = $this;
        extract($data);
        if (!empty($d)) extract($d);
        include "./src/views/$name.php";
    }

    function old($name)
    {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }
        return false;
    }

    function getSession($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return false;
    }

    function getValue($name)
    {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }
        return false;
    }


    function exibeDataPtBr($data)
    {
        $data = date('d/m/Y', strtotime($data));
        return $data;
    }

    function horaPorExtenso($i)
    {
        if ($i < 10) {
            $hora = "0$i:00";
        } else {
            $hora = "$i:00";
        }

        return $hora;
    }

    function setSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    function previous()
    {
        // previus url
        $url = $_SERVER['HTTP_REFERER'];
        return $url;
    }

    function converteDinheiroReal($value = null)
    {

        if ($value) {
            $value = number_format($value, 2, ',', '.');
            return $value;
        }
    }

    function retornaAgendaInfo($dia, $hora)
    {
        $agenda = $this->mysql()->row("SELECT * FROM agenda WHERE dia = '$dia' AND hora = '$hora'");
        return $agenda;
    }

    function retornaUsuarioInfo($id)    
    {   
        $id = $this->getSession('id');
        $usuario = $this->mysql()->row("SELECT * FROM usuarios WHERE id = $id");
        return $usuario;
    }

    function mysqlView()
    {
        return  $this->mysql();
    }
}
