<?php
require_once("objetos/pagina.php");
require_once("config/base-datos.php");
 
$database = new BaseDatos();
$db = $database->traerConexion();
            
// initialize object
$pag = new Pagina($db);

	// si el elemento insertar no viene nulo llama al crud e inserta un libro
if (isset($_POST['insertar'])) {
    
    // // Allow certain file formats 
    // $allowTypes = array('jpg','png','jpeg','gif'); 
    // if(in_array($fileType, $allowTypes)){ 
    //     $image = $_FILES['image']['tmp_name']; 
    //     $imgContent = addslashes(file_get_contents($image)); 
        
    //     // Insert image content into database 
    //     //$insert = $db->query("INSERT into images (image, uploaded) VALUES ('$imgContent', NOW())"); 

    // }

    $pag->nombre = $_POST["pag_nombre"];
    $pag->descripcion = $_POST["pag_descripcion"];

    $pag->orden = $_POST["pag_orden"];

    if(isset($_POST['pag_visible'])) {
        $pag->visible = 1;
    }
    else {
        $pag->visible = 0;
    }

    $cant_prod = $_POST["pag_tipo_radio"];
    $pag->cant_prod = $cant_prod;
    
    if($cant_prod == 2 || $cant_prod == 4) {
        $pag->prod_1_cod = $_POST["prod_1_cod"];
        $pag->prod_1_nom = $_POST["prod_1_nom"];
        $pag->prod_1_des = $_POST["prod_1_desc"];
        $pag->prod_1_pre = $_POST["prod_1_pre"];
        $pag->prod_2_cod = $_POST["prod_2_cod"];
        $pag->prod_2_nom = $_POST["prod_2_nom"];
        $pag->prod_2_des = $_POST["prod_2_desc"];
        $pag->prod_2_pre = $_POST["prod_2_pre"];
    }
    
    if($cant_prod == 4) {
        $pag->prod_3_cod = $_POST["prod_3_cod"];
        $pag->prod_3_nom = $_POST["prod_3_nom"];
        $pag->prod_3_des = $_POST["prod_3_desc"];
        $pag->prod_3_pre = $_POST["prod_3_pre"];
        $pag->prod_4_cod = $_POST["prod_4_cod"];
        $pag->prod_4_nom = $_POST["prod_4_nom"];
        $pag->prod_4_des = $_POST["prod_4_desc"];
        $pag->prod_4_pre = $_POST["prod_4_pre"];
    }
    

    //Me traigo le imagen
    $image = $_FILES['pag_imagen']['name'];

    $fecha = date_create();
    $fecha_append = date_timestamp_get($fecha);

    // image file directory
    $target = "uploads/images/". $fecha_append . "_"  .basename($image);

    $pag->imagen = $target;

    move_uploaded_file($_FILES['pag_imagen']['tmp_name'], $target);

    if($pag->crear()) {
        // $_SESSION["message"] == "La página ha sido creada correctamente";
        echo "<script>alert('ando');</script>";
        //header('Location: index.php');
    }
    else {
        // $_SESSION["message"] == "Hubo un error creando la página";
        echo "<script>alert('fallo');</script>";
        //header('Location: dist/paginas.php');
    }

    

// si el elemento de la vista con nombre actualizar no viene nulo, llama al crud y actualiza el libro
}

elseif(isset($_POST['actualizar'])){
    $libro->setId($_POST['id']);
    $libro->setNombre($_POST['nombre']);
    $libro->setAutor($_POST['autor']);
    $libro->setAnio_edicion($_POST['edicion']);
    $crud->actualizar($libro);
    header('Location: index.php');
// si la variable accion enviada por GET es == 'e' llama al crud y elimina un libro
}

elseif ($_GET['accion']=='e') {
    $crud->eliminar($_GET['id']);
    header('Location: index.php');		
// si la variable accion enviada por GET es == 'a', envía a la página actualizar.php 
}

elseif($_GET['accion']=='a'){
    header('Location: actualizar.php');
}
?>