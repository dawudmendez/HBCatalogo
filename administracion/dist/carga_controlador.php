<?php
require_once("session.php");
require_once("acceso_admin.php");
require_once("objetos/carga_excel.php");
require_once("config/base-datos.php");

require "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

 
$database = new BaseDatos();
$db = $database->traerConexion();
            
// initialize object
$carga = new CargaExcel($db);

	// si el elemento insertar no viene nulo llama al crud e inserta un libro
if (isset($_POST['crear'])) {

    try
    {
        //Me traigo el archivo excel
        $excel_file = $_FILES['input_archivo_excel']['name'];

        $allowed_extension = array('xls', 'xlsx');
        $file_array = explode(".", $excel_file);
        $file_extension = end($file_array);

        if(!in_array($file_extension, $allowed_extension)) {
            
        }
        
        // $file_type = IOFactory::identify($excel_file);
        //Subo el archivo al servidor
        $file_name = time() . '.' . $file_extension;        
        move_uploaded_file($_FILES['input_archivo_excel']['tmp_name'], $file_name);

        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

        $spreadsheet = $reader->load($file_name);

        unlink($file_name);

        $data = $spreadsheet->getActivesheet()->toArray();

        $result = true;
        $datos = false;

        if (!$carga->truncate())
        {
            http_response_code(500);
            exit;
        }

        foreach ($data as $row)
        {
            if(!is_numeric($row[0]))
                continue;

            $datos = true;
            $insert_data = array(
                ':prod_cod' => $row[0],
                ':precio' => $row[18]
            );

            $carga->prod_id = $row[0];
            $carga->precio = $row[18];

            if(!$carga->cargar()) {
                $result = false;
                break;
            } 
        }
        
        if(!$datos)
        {
            var_dump(http_response_code(400));
            exit;
        }

        if(!$result)
        {
            http_response_code(500);
            exit;
        }
        
        if (!$carga->validar())
        {
            http_response_code(500);
            exit;
        }
    
        $stmt = $carga->traer();
        $num = $stmt->rowCount();
        
        // check if more than 0 record found
        if($num>0){  
            // products array
            $excel_arr = array();
            //$paginas_arr["records"]=array();
        
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
        
                $excel_item = array(
                    "prod_cod" => $prod_cod,
                    "precio" => $precio,
                    "estado" => $estado,
                    "detalle" => $detalle,
                    "fecha_inicio" => $fecha_inicio,
                    "fecha_estado" => $fecha_estado,
                    "pag_orden" => $pag_orden,
                    "prod_num" => $prod_num
                );
        
                array_push($excel_arr, $excel_item);
            }
        
        }

        http_response_code(200);
        echo json_encode($excel_arr);
        exit;

    }
    catch (Exception $e)
    {
        http_response_code(500);
    }

}

elseif(isset($_POST['modificar'])){

    try
    {
        
        if (!$carga->modificar())
        {
            http_response_code(500);
            exit;
        }

        http_response_code(200);
        exit;

    }
    catch (Exception $e)
    {
        http_response_code(500);
    }
    
}

elseif($_GET['accion']=='ver') {
    header('Location: carga_excel.php');
}

?>