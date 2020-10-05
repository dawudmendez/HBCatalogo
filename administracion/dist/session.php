<?php

session_set_cookie_params(0);
session_start();

$admin_mode = false;

require_once("objetos/configuracion.php");
require_once("config/base-datos.php");

$database = new BaseDatos();
$db = $database->traerConexion();

$conf = new Configuracion($db);

if(!$conf->traer()) {
    $_SESSION['message_text'] = "No se pudo cargar la configuración.";
    $_SESSION['message_type'] = "danger";
    header('Location: index.php');
}

$_SESSION["nombre_sitio"] = $conf->empresa;
$_SESSION["url_catalogo"] = $conf->url_catalogo;
$_SESSION["logo"] = $conf->logo;

if($admin_mode == true) {
    $_SESSION['usu_usuario'] = "capo";
    $_SESSION['usu_nombre'] = "Capo";
    $_SESSION['usu_apellido'] = "Total";
    $_SESSION['usu_admin'] = 1;
}
else {
    if(!isset($_SESSION['usu_usuario']) || $_SESSION['usu_usuario'] == "") {
        header('Location: login.php');
    }
}


?>