<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

//Url
function base_url()
{
    return BASE_URL;
}

function routes()
{
    return json_encode(ROUTES);
}

function media()
{
    return BASE_URL . 'Assets/';
}

function headerAdmin($data = "")
{
    $view_header = "Views/Partials/header_admin.php";
    require_once($view_header);
}

function footerAdmin($data = "")
{
    $view_footer = "Views/Partials/footer_admin.php";
    require_once($view_footer);
}

//Formatear array
function dep($data)
{
    $format = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('<pre>');
    return $format;
}


function tiempo_a_decimal($hora)
{
    $HoraArr = explode(':', $hora);
    $hora_decimal = ($HoraArr[0] * 60) + ($HoraArr[1]) + ($HoraArr[2] / 60);
    return $hora_decimal;
}

function decimal_a_tiempo($decimal)
{
    $horas = floor($decimal / 60);
    $minutos = floor($decimal % 60);
    $segundos = $decimal - (int)$decimal;
    $segundos = round($segundos * 60);
    return str_pad($horas, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minutos, 2, "0", STR_PAD_LEFT) . ":" . str_pad($segundos, 2, "0", STR_PAD_LEFT);
}

function validar_festivos($fecha)
{
    $timestamp = strtotime($fecha);
    $weekday = date("l", $timestamp);
    if ($weekday == "Saturday" or $weekday == "Sunday") {
        return true;
    } else {
        return false;
    }
}

function validar_fecha($fecha)
{
    $valores = explode('-', $fecha);
    if (count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])) {
        return true;
    }
    return false;
}

function validar_nombre_usuario($nombre)
{
    return preg_match('/^[a-z\d_]{4,28}$/i', $nombre);
}

function validar_nombre_completo($nombre)
{
    return preg_match('/^[a-zñÑáéíóú\d_\s]{4,28}$/i', $nombre);
}

function validar_telefono($telefono)
{
    return preg_match('/^[0-9]{10,10}$/', $telefono);
}

function validar_email($email)
{
    return preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email);
}

function validar_fecha_v2($fecha)
{
    return preg_match('/^(\d\d\/\d\d\/\d\d\d\d){1,1}$/', $fecha);
}

function validar_web($url)
{
    if (strlen($url) > 0)
        return preg_match('/^[http:\/\/|www.|https:\/\/]/i', $url);
}

function validar_requerido($texto)
{
    return !(trim($texto) == '');
}

function validar_entero($numero)
{
    return filter_var($numero, FILTER_VALIDATE_INT);
}

function limpiar_cadena($string): String
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = str_ireplace("<script>", "", $string);
    $string = str_ireplace("</script>", "", $string);
    $string = str_ireplace("<script src>", "", $string);
    $string = str_ireplace("<script type=>", "", $string);
    $string = str_ireplace("SELECT * FROM", "", $string);
    $string = str_ireplace("DELETE FROM", "", $string);
    $string = str_ireplace("INSERT INTO", "", $string);
    $string = str_ireplace("UPDATE", "", $string);
    $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
    $string = str_ireplace("DROP TABLE", "", $string);
    $string = str_ireplace("OR '1'='1'", "", $string);
    $string = str_ireplace('OR "1"="1"', "", $string);
    $string = str_ireplace("OR ´1´=´1´", "", $string);
    $string = str_ireplace("OR 'a'='a'", "", $string);
    $string = str_ireplace("OR ´a´=´a´", "", $string);
    $string = str_ireplace('OR "a"="a"', "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("LIKE '", "", $string);
    $string = str_ireplace('LIKE "', "", $string);
    $string = str_ireplace("LIKE ´", "", $string);
    $string = str_ireplace("<?php", "", $string);
    $string = str_ireplace("<?php", "", $string);
    $string = str_ireplace("<?", "", $string);
    $string = str_ireplace("¿>", "", $string);
    $string = str_ireplace("==", "", $string);
    $string = str_ireplace("[", "", $string);
    $string = str_ireplace("]", "", $string);
    $string = str_ireplace("^", "", $string);
    $string = str_ireplace("--", "", $string);
    return $string;
}


function generar_contrasena($longitud = 10)
{
    $contrasena = "";
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijqlmnopqrstuvwxyz1234567890";
    $longitud_cadena = strlen($cadena);
    for ($i = 1; $i <= $longitud; $i++) {
        $pos = rand(0, $longitud_cadena - 1);
        $contrasena .= substr($cadena, $pos, 1);
    }
    return $contrasena;
}
