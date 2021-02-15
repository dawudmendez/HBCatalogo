<?php

class CargaExcel {
    private $con;
    private $nombre_tabla = "carga_excel";

    private $INICIAL = "Inicial";
    private $ERROR = "Error";
    private $VALIDO = "Válido";
    private $PRODUCTO_INEXISTENTE = "No existe producto con este código";
    private $PRECIO_INVALIDO = "El precio tiene un formato inválido.";
    private $VALIDO_MENSAJE = "Este producto será modificado.";

    //propiedades del objeto
    public $prod_id;
    public $precio;
    public $estado;
    public $detalle;
    public $fecha_inicio;
    public $fecha_estado;
    public $pag_id;
    public $prod_num;
    public $pag_orden;

    public function __construct($db){
        $this->con = $db;   
        $this->changeMode();     
    }

    function changeMode() {
        $query = "SET SESSION sql_mode = ''";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
    }  

    public function truncate() {
        $query = "TRUNCATE TABLE " . $this->nombre_tabla;

        $stmt = $this->con->prepare($query);

        if($stmt->execute()){
            return true;
        }

        //echo $stmt->error;
        print_r($stmt->errorInfo());

        return false;
    }

    public function cargar() {

        $query = "INSERT INTO " . $this->nombre_tabla . "
        SET
            prod_cod = :prod_cod,
            precio = :precio,
            estado = :estado,
            detalle = :detalle,
            fecha_inicio = :fecha_inicio,
            fecha_estado = :fecha_estado,
            pag_id = :pag_id,
            prod_num = :prod_num,
            pag_orden = :pag_orden
            ";

        //preparo la query
        $stmt = $this->con->prepare($query);

        $this->prod_id=htmlspecialchars(strip_tags($this->prod_id));
        $this->precioprecio=htmlspecialchars(strip_tags($this->precio));

        //bindeo los parámetros
        $stmt->bindParam(':prod_cod', $this->prod_id);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':detalle', $this->detalle);
        $stmt->bindParam(':fecha_inicio', $this->fecha_inicio);
        $stmt->bindParam(':fecha_estado', $this->fecha_estado);
        $stmt->bindParam(':pag_id', $this->pag_id);
        $stmt->bindParam(':prod_num', $this->prod_num);
        $stmt->bindParam(':pag_orden', $this->pag_orden);
    
        //ejecuto el query y devuelvo true si salió todo bien
        if($stmt->execute()){
            return true;
        }

        //echo $stmt->error;
        print_r($stmt->errorInfo());

        return false;
    }

    public function validar() {
        //Pongo todas las fechas de inicio
        $query = "UPDATE " . $this->nombre_tabla . "
            SET fecha_inicio = current_timestamp(),
                estado = :estado";      
        
        $stmt = $this->con->prepare($query);

        $stmt->bindParam(':estado', $this->INICIAL);

        if(!$stmt->execute())
        { 
            return false;
        }

        //Valido que tenga precio y que sea numérico
        $query = "UPDATE " . $this->nombre_tabla . "
            SET estado = :estado_new,
                detalle = :detalle
            WHERE estado = :estado_old
            AND precio NOT REGEXP '^[0-9]*[.]{0,1}[0-9]*$'
            OR precio is null";

        $stmt = $this->con->prepare($query);
        
        $stmt->bindParam(':estado_old', $this->INICIAL);
        $stmt->bindParam(':estado_new', $this->ERROR);
        $stmt->bindParam(':detalle', $this->PRECIO_INVALIDO);

        if(!$stmt->execute())
        { 
            return false;
        }


        //Asigno los productos y páginas
        //Prod1
        $query = "UPDATE " . $this->nombre_tabla . " e
            INNER JOIN paginas p ON e.prod_cod = p.prod_1_cod
            SET pag_id = p.id,
                pag_orden = p.orden,
                prod_num = 1,
                estado = :estado_new,
                detalle = :detalle
            WHERE estado = :estado_old";

        $stmt = $this->con->prepare($query);
        
        $stmt->bindParam(':estado_old', $this->INICIAL);
        $stmt->bindParam(':estado_new', $this->VALIDO);
        $stmt->bindParam(':detalle', $this->VALIDO_MENSAJE);

        if(!$stmt->execute())
        { 
            return false;
        }


        //Prod2
        $query = "UPDATE " . $this->nombre_tabla . " e
        INNER JOIN paginas p ON e.prod_cod = p.prod_2_cod
        SET pag_id = p.id,
            pag_orden = p.orden,
            prod_num = 2,
            estado = :estado_new,
            detalle = :detalle
        WHERE estado = :estado_old";

        $stmt = $this->con->prepare($query);
        
        $stmt->bindParam(':estado_old', $this->INICIAL);
        $stmt->bindParam(':estado_new', $this->VALIDO);
        $stmt->bindParam(':detalle', $this->VALIDO_MENSAJE);

        if(!$stmt->execute())
        { 
            return false;
        }


        //Prod3
        $query = "UPDATE " . $this->nombre_tabla . " e
        INNER JOIN paginas p ON e.prod_cod = p.prod_3_cod
        SET pag_id = p.id,
            prod_num = 3,
            estado = :estado_new,
            detalle = :detalle
        WHERE estado = :estado_old";

        $stmt = $this->con->prepare($query);
        
        $stmt->bindParam(':estado_old', $this->INICIAL);
        $stmt->bindParam(':estado_new', $this->VALIDO);        
        $stmt->bindParam(':detalle', $this->VALIDO_MENSAJE);

        if(!$stmt->execute())
        { 
            return false;
        }


        //Prod4
        $query = "UPDATE " . $this->nombre_tabla . " e
        INNER JOIN paginas p ON e.prod_cod = p.prod_4_cod
        SET pag_id = p.id,
            prod_num = 4,
            estado = :estado_new,
            detalle = :detalle
        WHERE estado = :estado_old";

        $stmt = $this->con->prepare($query);
        
        $stmt->bindParam(':estado_old', $this->INICIAL);
        $stmt->bindParam(':estado_new', $this->VALIDO);
        $stmt->bindParam(':detalle', $this->VALIDO_MENSAJE);

        if(!$stmt->execute())
        { 
            return false;
        }


        //Marco todos los que quedaron como inválidos por no existir producto
        //Pongo todas las fechas de inicio
        $query = "UPDATE " . $this->nombre_tabla . "
            SET estado = :estado_new,
                detalle = :detalle
            WHERE estado = :estado_old";      
        
        $stmt = $this->con->prepare($query);

        $stmt->bindParam(':estado_new', $this->ERROR);
        $stmt->bindParam(':estado_old', $this->INICIAL);
        $stmt->bindParam(':detalle', $this->PRODUCTO_INEXISTENTE);

        if(!$stmt->execute())
        { 
            return false;
        }
        

        return true;
    }

    public function traer() {
        try
        {
            //traigo todos
            $query = "SELECT prod_cod, precio, estado, detalle, fecha_inicio, fecha_estado,
                pag_orden, prod_num
                FROM " . $this->nombre_tabla . "
                order by prod_cod asc";

            //preparo la query
            $stmt = $this->con->prepare($query);

            //ejecuto la query
            $stmt->execute();

            return $stmt;
            
        }
        catch (Exception $e)
        {
            throw $e;
        }
        
    }

    public function modificar() {
        //Todos los productos 1
        $query = "UPDATE paginas p
        INNER JOIN " . $this->nombre_tabla . " e ON e.prod_cod = p.prod_1_cod
        AND p.id = e.pag_id
        SET prod_1_pre = e.precio
        WHERE e.estado = :estado";  
        
        $stmt = $this->con->prepare($query);

        $stmt->bindParam(':estado', $this->VALIDO);

        if(!$stmt->execute())
        { 
            return false;
        }

        //Todos los productos 2
        $query = "UPDATE paginas p
        INNER JOIN " . $this->nombre_tabla . " e ON e.prod_cod = p.prod_2_cod
        AND p.id = e.pag_id
        SET prod_2_pre = e.precio
        WHERE e.estado = :estado";  
        
        $stmt = $this->con->prepare($query);

        $stmt->bindParam(':estado', $this->VALIDO);

        if(!$stmt->execute())
        { 
            return false;
        }

        //Todos los productos 3
        $query = "UPDATE paginas p
        INNER JOIN " . $this->nombre_tabla . " e ON e.prod_cod = p.prod_3_cod
        AND p.id = e.pag_id
        SET prod_3_pre = e.precio
        WHERE e.estado = :estado";  
        
        $stmt = $this->con->prepare($query);

        $stmt->bindParam(':estado', $this->VALIDO);

        if(!$stmt->execute())
        { 
            return false;
        }

        //Todos los productos 4
        $query = "UPDATE paginas p
        INNER JOIN " . $this->nombre_tabla . " e ON e.prod_cod = p.prod_4_cod
        AND p.id = e.pag_id
        SET prod_4_pre = e.precio
        WHERE e.estado = :estado";  
        
        $stmt = $this->con->prepare($query);

        $stmt->bindParam(':estado', $this->VALIDO);

        if(!$stmt->execute())
        { 
            return false;
        }

        return true;
    }
}

?>