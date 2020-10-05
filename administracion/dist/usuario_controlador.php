<?php
require_once("session.php");
require_once("objetos/usuario.php");
require_once("config/base-datos.php");
 
$database = new BaseDatos();
$db = $database->traerConexion();
            
// initialize object
$usu = new Usuario($db);

	// si el elemento insertar no viene nulo llama al crud e inserta un libro
if (isset($_POST['insertar'])) {
    $usu->usuario = $_POST["usuario"];
    $usu->nombre = $_POST["nombre"];
    $usu->apellido = $_POST["apellido"];
    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $usu->password = $hashed_password;

    if($usu->crear()) {
        $_SESSION['message_text'] = "Usuario creado correctamente";
        $_SESSION['message_type'] = "success";
        header('Location: usuarios.php');
    }
    else {
        $_SESSION['message_text'] = "No se pudo crear el usuario.";
        $_SESSION['message_type'] = "danger";
        header('Location: usuarios_crear.php');
    }    

// si el elemento de la vista con nombre actualizar no viene nulo, llama al crud y actualiza el libro
}

elseif(isset($_POST['editar'])){
    
    $usu->traerUno($_SESSION['usu_usuario']);

    $usu->nombre = $_POST["nombre"];
    $usu->apellido = $_POST["apellido"];
    if(isset($_POST["password"]) && $_POST["password"] != "") {
        $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $usu->password = $hashed_password;
    }    

    if($usu->editar()) {
        $_SESSION['usu_usuario'] = $usu->usuario;
        $_SESSION['usu_nombre'] = $usu->nombre;
        $_SESSION['usu_apellido'] = $usu->apellido;
        $_SESSION['usu_admin'] = $usu->admin;

        $_SESSION['message_text'] = "Perfil modificado correctamente.";
        $_SESSION['message_type'] = "success";
        header('Location: index.php');
    }
    else {
        $_SESSION['message_text'] = "No se pudo modificar el perfil.";
        $_SESSION['message_type'] = "danger";
        header('Location: index.php');
    }
}

elseif(isset($_POST['login'])){
    
    if($usu->login($_POST['usuario'])) {
        if(password_verify($_POST['password'], $usu->password)) {
            $_SESSION['usu_usuario'] = $usu->usuario;
            $_SESSION['usu_nombre'] = $usu->nombre;
            $_SESSION['usu_apellido'] = $usu->apellido;
            $_SESSION['usu_admin'] = $usu->admin;

            header('Location: index.php');
        }  
        else
        {
            $_SESSION['message_text'] = "Datos incorrectos, reintente.";
            $_SESSION['message_type'] = "danger";
            header('Location: login.php');
        }      
    }
    else
    {
        $_SESSION['message_text'] = "Datos incorrectos, reintente.";
        $_SESSION['message_type'] = "danger";
        header('Location: login.php');
    }

}

elseif (isset($_POST['eliminar'])) {
    if($usu->eliminar($_POST['usuario'])) {
        $_SESSION['message_text'] = "Usuario eliminado correctamente";
        $_SESSION['message_type'] = "success";
        header('Location: usuarios.php');		
    }
    else {
        $_SESSION['message_text'] = "No se pudo eliminar el usuario.";
        $_SESSION['message_type'] = "danger";
        header('Location: usuarios.php');
    }
}

elseif (isset($_POST['validar'])) {
    if($usu->validarUsuario($_POST['usuario'])) {
        echo "true";
    }
    else {
        echo "false";
    }
}

elseif($_GET['accion']=='ver_todas') {    
    header('Location: usuarios.php');
}

elseif($_GET['accion']=='ver') {
    $verid = $_GET['usuario'];
    //print_r("paginas_ver.php?id=" . $verid);
    header('Location: usuarios_ver.php?id=' . $verid);
}

elseif($_GET['accion']=='crear') {
    header('Location: usuarios_crear.php');
    
}

elseif($_GET['accion']=='editar') {
    header('Location: usuarios_editar.php');
}

elseif($_GET['accion']=='cerrar') {
    session_destroy();
    header('Location: index.php');
}

?>