<?php
require_once("session.php");
require_once("acceso_admin.php");
require_once("objetos/carga_excel.php");
require_once("config/base-datos.php");
 
$database = new BaseDatos();
$db = $database->traerConexion();
            
// initialize object
$pag = new Pagina($db);

	// si el elemento insertar no viene nulo llama al crud e inserta un libro
if (isset($_POST['crear'])) {

    try
    {
        $pag->nombre = $_POST["pag_nombre"];
        $pag->descripcion = $_POST["pag_descripcion"];

        $cant_prod = $_POST["pag_tipo_radio"];
        $pag->cant_prod = $cant_prod;

        $pag->orden = $_POST["pag_orden"];        
        
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
        
        //Me traigo la imagen
        $excel_file = $_FILES['input_archivo_excel']['name'];

        $allowed_extension = array('xls', 'xlsx');
        $file_array = explode(".", excel_file);
        $file_extension = end($file_array);

        if(!in_array($file_extension, $allowed_extension)) {
            
        }
        
        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($excel_file);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);
        $spreadsheet = $reader->load($excel_file);
        $data = $spreadsheet->getActivesheet()->toArray();

        foreach ($data as $row)
        {
            $insert_data = array(
                ':prod_cod' => $row[0],
                ':precio' => $row[18]
            );
        }

        $fecha = date_create();
        $fecha_append = date_timestamp_get($fecha);

        // image file directory
        $target = "uploads/images/". $fecha_append . "_"  .basename($image);

        $pag->imagen = $target;

        move_uploaded_file($_FILES['pag_imagen']['tmp_name'], $target);

        if($pag->crear()) {
            $_SESSION['message_text'] = "Página creada correctamente.";
            $_SESSION['message_type'] = "success";
            header('Location: paginas.php');
        }
        else {
            $_SESSION['message_text'] = "No se pudo crear la página.";
            $_SESSION['message_type'] = "danger";
            header('Location: paginas.php');
        }

    }
    catch (Exception $e)
    {
        $_SESSION['message_text'] = "No se pudo crear la página.";
            $_SESSION['message_type'] = "danger";
            header('Location: paginas.php');
    }

}

elseif(isset($_POST['editar'])){

    try
    {
        if(!isset($_POST['id'])) {
            header('Location: paginas.php');		
        }
    
        $id_editar = $_POST['id'];
    
        $pag->traerUno($id_editar);
        $pag->nombre = $_POST["pag_nombre"];
        $pag->descripcion = $_POST["pag_descripcion"];
    
        $pag->orden = $_POST["pag_orden"];
    
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
        if(isset( $_FILES['pag_imagen']['name'])) {
    
            $image = $_FILES['pag_imagen']['name'];
    
            if(basename($image) != "")
            {
                //Borro la imagen del disco
                unlink($pag->imagen);
    
                header('Location: paginas.php');
    
                $fecha = date_create();
                $fecha_append = date_timestamp_get($fecha);
    
                // image file directory
                $target = "uploads/images/". $fecha_append . "_"  .basename($image);
    
                $pag->imagen = $target;
    
                move_uploaded_file($_FILES['pag_imagen']['tmp_name'], $target);
    
            }
            
        }
        
    
        if($pag->editar()) {
            $_SESSION['message_text'] = "Página modificada correctamente.";
            $_SESSION['message_type'] = "success";
            header('Location: paginas.php');
        }
        else {
            $_SESSION['message_text'] = "No se pudo modificar la página.";
            $_SESSION['message_type'] = "danger";
            header('Location: paginas.php');
        }
        
    }
    catch (Exception $e)
    {
        $_SESSION['message_text'] = "No se pudo modificar la página.";
        $_SESSION['message_type'] = "danger";
        header('Location: paginas.php');
    }
    
}

elseif (isset($_POST['eliminar'])) {
    try
    {
        if($pag->eliminar($_POST['id'])) {
            $_SESSION['message_text'] = "Página eliminada correctamente.";
            $_SESSION['message_type'] = "success";
            header('Location: paginas.php');		
        }
        else {
            $_SESSION['message_text'] = "No se pudo eliminar la página.";
            $_SESSION['message_type'] = "danger";
            header('Location: paginas.php');
        }
    }
    catch (Exception $e)
    {
        $_SESSION['message_text'] = "No se pudo eliminar la página.";
        $_SESSION['message_type'] = "danger";
        header('Location: paginas.php');
    }
    
}

elseif($_GET['accion']=='ver') {
    header('Location: carga_excel.php');
}

elseif($_GET['accion']=='ver') {
    $verid = $_GET['id'];
    //print_r("paginas_ver.php?id=" . $verid);
    header('Location: paginas_ver.php?id=' . $verid);
}

elseif($_GET['accion']=='crear') {
    header('Location: paginas_crear.php');
    
}

elseif($_GET['accion']=='editar') {
    $editarid = $_GET['id'];
    header('Location: paginas_editar.php?id=' . $editarid);
}

?>