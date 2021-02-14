<?php

class CargaExcel {
    private $con;
    private $nombre_tabla = "carga_excel";

    private const ERROR = "Error";
    private const VALIDO = "Válido";
    private const PRODUCTO_INEXISTENTE = "No existe producto con este código";
    private const PRECIO_INVALIDO = "El precio tiene un formato inválido. Debería ser un número con dos decimales.";

    //propiedades del objeto
    public $prod_id;
    public $precio;
    public $estado;
    public $detalle;
    public $fecha_inicio;
    public $fecha_estado;

    public function __construct($db){
        $this->con = $db;   
        $this->changeMode();     
    }

    function changeMode() {
        $query = "SET SESSION sql_mode = ''";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
    }

    public function traerDetalle() {
        //traigo todos
        $query = "SELECT prod_cod, precio, estado, detalle, fecha_inicio, fecha_estado
                FROM " . $this->nombre_tabla;
    
        //preparo la query
        $stmt = $this->con->prepare($query);
    
        //ejecuto la query
        $stmt->execute();
    
        return $stmt;
    }

    public function cargar($excel) {

        foreach ($excel as $row)
        {
            $insert_data = array(
                ':prod_cod' => $row[0],
                ':precio' => $row[18]
            );

            $query = "INSERT INTO " . $this->nombre_tabla . "
            SET
                prod_cod = :nombre,
                precio = :descripcion,
                estado = :imagen,
                detalle = :cant_prod,
                fecha_inicio = :orden,
                fecha_estado = :prod_1_cod
                ";
    
            //preparo la query
            $stmt = $this->con->prepare($query);

            $insert_data->prod_cod=htmlspecialchars(strip_tags($insert_data->prod_cod));
            $insert_data->precio=htmlspecialchars(strip_tags($insert_data->precio));

            //bindeo los parámetros
            $stmt->bindParam(':estado', null);
            $stmt->bindParam(':detalle', null);
            $stmt->bindParam(':fecha_inicio', null);
            $stmt->bindParam(':fecha_estado', null);
        
            //ejecuto el query y devuelvo true si salió todo bien
            if($stmt->execute()){
                return true;
            }

            //echo $stmt->error;
            print_r($stmt->errorInfo());

            return false;
        }

        return true;
    }

    public function validar() {
        //traigo todos
        $query = "SELECT usuario, nombre, apellido, password, admin
                FROM " . $this->nombre_tabla;
    
        //preparo la query
        $stmt = $this->con->prepare($query);
    
        //ejecuto la query
        $stmt->execute();
    
        return $stmt;
    }

    public function modificar() {
        //traigo todos
        $query = "SELECT usuario, nombre, apellido, password, admin
                FROM " . $this->nombre_tabla;
    
        //preparo la query
        $stmt = $this->con->prepare($query);
    
        //ejecuto la query
        $stmt->execute();
    
        return $stmt;
    }
}

?>