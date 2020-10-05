<?php
require_once("session.php");
require_once("objetos/vendedor.php");
require_once("config/base-datos.php");
 
$database = new BaseDatos();
$db = $database->traerConexion();
            
// initialize object
$vend = new Vendedor($db);

	// si el elemento insertar no viene nulo llama al crud e inserta un libro
if (isset($_POST['insertar'])) {

    $vend->usuario = $_POST["usuario"];
    $vend->nombre = $_POST["nombre"];
    $vend->apellido = $_POST["apellido"];
    $vend->email = $_POST["email"];
    $vend->whatsapp = $_POST["whatsapp"];  
    $vend->link = $_SESSION["url_catalogo"] . "?vend=" . $_POST["usuario"];

    if($vend->crear()) {
        // $_SESSION["message"] == "La página ha sido creada correctamente";
        //echo "<script>alert('ando');</script>";
        $_SESSION['message_text'] = "Vendedor creado correctamente";
        $_SESSION['message_type'] = "success";
        header('Location: vendedores.php');
    }
    else {
        // $_SESSION["message"] == "Hubo un error creando la página";
        //echo "<script>alert('fallo');</script>";
        $_SESSION['message_text'] = "No se pudo agregar el vendedor.";
        $_SESSION['message_type'] = "danger";
        header('Location: vendedores.php');
    }    

// si el elemento de la vista con nombre actualizar no viene nulo, llama al crud y actualiza el libro
}

elseif(isset($_POST['editar'])){
    if(!isset($_POST['id'])) {
        $_SESSION['message_text'] = "El vendedor no existe.";
        $_SESSION['message_type'] = "danger";
        header('Location: vendedores.php');		
    }

    $id_editar = $_POST['id'];

    $vend->traerUno($id_editar);
    $vend->usuario = $_POST["usuario"];
    $vend->nombre = $_POST["nombre"];
    $vend->apellido = $_POST["apellido"];
    $vend->email = $_POST["email"];
    $vend->whatsapp = $_POST["whatsapp"];
    $vend->link = $_SESSION["url_catalogo"] . "?vend=" . $_POST["usuario"];

    if($vend->editar()) {
        // $_SESSION["message"] == "La página ha sido creada correctamente";
        //echo "<script>alert('ando');</script>";
        $_SESSION['message_text'] = "Vendedor modificado correctamente.";
        $_SESSION['message_type'] = "success";
        header('Location: vendedores.php');
    }
    else {
        // $_SESSION["message"] == "Hubo un error creando la página";
        //echo "<script>alert('fallo');</script>";
        $_SESSION['message_text'] = "No se pudo modificar el vendedor.";
        $_SESSION['message_type'] = "danger";
        header('Location: vendedores.php');
    }
}

elseif (isset($_POST['eliminar'])) {
    if($vend->eliminar($_POST['id'])) {
        $_SESSION['message_text'] = "Vendedor eliminado correctamente";
        $_SESSION['message_type'] = "success";
        header('Location: vendedores.php');		
    }
    else {
        $_SESSION['message_text'] = "No se pudo eliminar el vendedor.";
        $_SESSION['message_type'] = "danger";
        header('Location: vendedores.php');
    }
}

elseif (isset($_POST['validar'])) {
    if($vend->validarUsuario($_POST['usuario'])) {
        echo "true";
    }
    else {
        echo "false";
    }
}

elseif($_GET['accion']=='ver_todas') {    
    header('Location: vendedores.php');
}

elseif($_GET['accion']=='ver') {
    $verid = $_GET['id'];
    //print_r("paginas_ver.php?id=" . $verid);
    header('Location: vendedores_ver.php?id=' . $verid);
}

elseif($_GET['accion']=='crear') {
    header('Location: vendedores_crear.php');
    
}

elseif($_GET['accion']=='editar') {
    $editarid = $_GET['id'];
    header('Location: vendedores_editar.php?id=' . $editarid);
}

?>