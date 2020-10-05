<?php
require_once("session.php");
require_once("objetos/configuracion.php");
require_once("config/base-datos.php");
 
$database = new BaseDatos();
$db = $database->traerConexion();
            
// initialize object
$conf = new Configuracion($db);

if(isset($_POST['editar'])){

    $conf->traer();

    $conf->empresa = $_POST["empresa"];
    $conf->url = $_POST["url"];
    $conf->url_catalogo = $_POST["url_catalogo"];
    $conf->mensaje = $_POST["mensaje"];
    $conf->direccion = $_POST["direccion"];
    $conf->localidad = $_POST["localidad"];
    $conf->telefono = $_POST["telefono"];
    $conf->whatsapp = $_POST["whatsapp"];

    //Me traigo le imagen
    if(isset($_FILES['portada']['name']) && $_FILES["portada"]["name"] != "") {
        //Borro la imagen del disco
        unlink($conf->portada);

        // $image = $_FILES['portada']['name'];

        // $fecha = date_create();
        // $fecha_append = date_timestamp_get($fecha);

        // // image file directory
        // $target = "uploads/images/". $fecha_append . "_"  .basename($image);

        // $conf->portada = $target;

        move_uploaded_file($_FILES['portada']['tmp_name'], $conf->portada);
    }

    //Me traigo le imagen
    if(isset($_FILES['logo']['name']) && $_FILES["logo"]["name"] != "") {

        //Borro la imagen del disco
        unlink($conf->logo);

        // $image = $_FILES['logo']['name'];

        // $fecha = date_create();
        // $fecha_append = date_timestamp_get($fecha);

        // // image file directory
        // $target = "uploads/images/". $fecha_append . "_"  .basename($image);

        // $conf->logo = $target;

        move_uploaded_file($_FILES['logo']['tmp_name'], $conf->logo);
    }
    

    if($conf->editar()) {
        // $_SESSION["message"] == "La página ha sido creada correctamente";
        //echo "<script>alert('ando');</script>";
        $_SESSION['message_text'] = "Configuración modificada correctamente.";
        $_SESSION['message_type'] = "success";
        header('Location: configuracion_ver.php');
    }
    else {
        // $_SESSION["message"] == "Hubo un error creando la página";
        //echo "<script>alert('fallo');</script>";
        $_SESSION['message_text'] = "No se pudo modificar la configuración.";
        $_SESSION['message_type'] = "danger";
        header('Location: configuracion.php');
    }
}

elseif($_GET['accion']=='editar') {
    header('Location: configuracion_editar.php');
} 

elseif($_GET['accion']=='ver') {
    header('Location: configuracion_ver.php');
} 