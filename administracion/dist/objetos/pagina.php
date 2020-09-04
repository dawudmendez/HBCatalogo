<?php

class Pagina{

    // onexión a la base y nombre de tabla
    private $con;
    private $nombre_tabla = "paginas";

    //propiedades del objeto
    public $id;
    public $nombre;
    public $descripcion;
    public $imagen;
    public $cant_prod;
    public $orden;
    public $visible;
    public $prod_1_cod;
    public $prod_1_nom;
    public $prod_1_des;
    public $prod_1_pre;
    public $prod_2_cod;
    public $prod_2_nom;
    public $prod_2_des;
    public $prod_2_pre;
    public $prod_3_cod;
    public $prod_3_nom;
    public $prod_3_des;
    public $prod_3_pre;
    public $prod_4_cod;
    public $prod_4_nom;
    public $prod_4_des;
    public $prod_4_pre;

    //constructor
    public function __construct($db){
        $this->con = $db;
    }

    function crear() {
        //insertar página
        $query = "INSERT INTO " . $this->nombre_tabla . "
                SET
                    nombre = :nombre,
                    descripcion = :descripcion,
                    imagen = :imagen,
                    cant_prod = :cant_prod,
                    orden = :orden,
                    visible = :visible,
                    prod_1_cod = :prod_1_cod,
                    prod_1_nom = :prod_1_nom,
                    prod_1_des = :prod_1_des,
                    prod_1_pre = :prod_1_pre,
                    prod_2_cod = :prod_2_cod,
                    prod_2_nom = :prod_2_nom,
                    prod_2_des = :prod_2_des,
                    prod_2_pre = :prod_2_pre,
                    prod_3_cod = :prod_3_cod,
                    prod_3_nom = :prod_3_nom,
                    prod_3_des = :prod_3_des,
                    prod_3_pre = :prod_3_pre,
                    prod_4_cod = :prod_4_cod,
                    prod_4_nom = :prod_4_nom,
                    prod_4_des = :prod_4_des,
                    prod_4_pre = :prod_4_pre
                    ";
    
        //preparo la query
        $stmt = $this->con->prepare($query);
    
        //le saco los tags, etc
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion=htmlspecialchars(strip_tags($this->descripcion));
        $this->imagen=htmlspecialchars(strip_tags($this->imagen));
        $this->cant_prod=htmlspecialchars(strip_tags($this->cant_prod));
        $this->orden=htmlspecialchars(strip_tags($this->orden));
        $this->visible=htmlspecialchars(strip_tags($this->visible));
        $this->prod_1_cod=htmlspecialchars(strip_tags($this->prod_1_cod));
        $this->prod_1_nom=htmlspecialchars(strip_tags($this->prod_1_nom));
        $this->prod_1_des=htmlspecialchars(strip_tags($this->prod_1_des));
        $this->prod_1_pre=htmlspecialchars(strip_tags($this->prod_1_pre));
        $this->prod_2_cod=htmlspecialchars(strip_tags($this->prod_2_cod));
        $this->prod_2_nom=htmlspecialchars(strip_tags($this->prod_2_nom));
        $this->prod_2_des=htmlspecialchars(strip_tags($this->prod_2_des));
        $this->prod_2_pre=htmlspecialchars(strip_tags($this->prod_2_pre));
        $this->prod_3_cod=htmlspecialchars(strip_tags($this->prod_3_cod));
        $this->prod_3_nom=htmlspecialchars(strip_tags($this->prod_3_nom));
        $this->prod_3_des=htmlspecialchars(strip_tags($this->prod_3_des));
        $this->prod_3_pre=htmlspecialchars(strip_tags($this->prod_3_pre));
        $this->prod_4_cod=htmlspecialchars(strip_tags($this->prod_4_cod));
        $this->prod_4_nom=htmlspecialchars(strip_tags($this->prod_4_nom));
        $this->prod_4_des=htmlspecialchars(strip_tags($this->prod_4_des));
        $this->prod_4_pre=htmlspecialchars(strip_tags($this->prod_4_pre));
    
        //bindeo los parámetros
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':imagen', $this->imagen);
        $stmt->bindParam(':cant_prod', $this->cant_prod);
        $stmt->bindParam(':orden', $this->orden);
        $stmt->bindParam(':visible', $this->visible);
        $stmt->bindParam(':prod_1_cod', $this->prod_1_cod);
        $stmt->bindParam(':prod_1_nom', $this->prod_1_nom);
        $stmt->bindParam(':prod_1_des', $this->prod_1_des);
        $stmt->bindParam(':prod_1_pre', $this->prod_1_pre);
        $stmt->bindParam(':prod_2_cod', $this->prod_2_cod);
        $stmt->bindParam(':prod_2_nom', $this->prod_2_nom);
        $stmt->bindParam(':prod_2_des', $this->prod_2_des);
        $stmt->bindParam(':prod_2_pre', $this->prod_2_pre);
        $stmt->bindParam(':prod_3_cod', $this->prod_3_cod);
        $stmt->bindParam(':prod_3_nom', $this->prod_3_nom);
        $stmt->bindParam(':prod_3_des', $this->prod_3_des);
        $stmt->bindParam(':prod_3_pre', $this->prod_3_pre);
        $stmt->bindParam(':prod_4_cod', $this->prod_4_cod);
        $stmt->bindParam(':prod_4_nom', $this->prod_4_nom);
        $stmt->bindParam(':prod_4_des', $this->prod_4_des);
        $stmt->bindParam(':prod_4_pre', $this->prod_4_pre);

        //Actualizo el orden primero
        if(!$this->subirOrden()) {
            return false;
        }
    
        //ejecuto el query y devuelvo true si salió todo bien
        if($stmt->execute()){
            return true;
        }

        //echo $stmt->error;
        print_r($stmt->errorInfo());
    
        return false;
    }

    private function subirOrden() {
        //updato los orden
        $query = "UPDATE " . $this->nombre_tabla . "
                SET orden = orden + 1                
                WHERE orden >= ?";
    
        //preparo the query
        $stmt = $this->con->prepare($query);
    
        //sanitizo
        $this->orden=htmlspecialchars(strip_tags($this->orden));
    
        //bindeo el id
        $stmt->bindParam(1, $this->orden);
    
        //ejecuto el query
        if($stmt->execute()) {
            return true;
        }
        else {
            //echo $stmt->error;
            print_r($stmt->errorInfo());
            return false;
        }
    }

    private function bajarOrden() {
        //updato los orden
        $query = "UPDATE " . $this->nombre_tabla . "
                SET orden = orden - 1                
                WHERE orden > ?";
    
        //preparo the query
        $stmt = $this->con->prepare($query);
    
        //sanitizo
        $this->orden=htmlspecialchars(strip_tags($this->orden));
    
        //bindeo el id
        $stmt->bindParam(1, $this->orden);
    
        //ejecuto el query
        if($stmt->execute()) {
            return true;
        }
        else {
            //echo $stmt->error;
            print_r($stmt->errorInfo());
            return false;
        }
    }

    function traer() {
        //traigo todos
        $query = "SELECT id, nombre, descripcion, imagen, orden, visible
                FROM " . $this->nombre_tabla . "
                order by orden asc";
    
        //preparo la query
        $stmt = $this->con->prepare($query);
    
        //ejecuto la query
        $stmt->execute();
    
        return $stmt;
    }

    function traerUno($id) {
        //traigo por id
        $query = "SELECT id, nombre, descripcion, imagen, cant_prod, orden, visible,
                    prod_1_cod, prod_1_nom, prod_1_des, prod_1_pre,
                    prod_2_cod, prod_2_nom, prod_2_des, prod_2_pre,
                    prod_3_cod, prod_3_nom, prod_3_des, prod_3_pre,
                    prod_4_cod, prod_4_nom, prod_4_des, prod_4_pre
                FROM " . $this->nombre_tabla . "
                WHERE id = ?";
    
        //preparo the query
        $stmt = $this->con->prepare($query);
    
        //sanitizo
        $this->id=htmlspecialchars(strip_tags($id));
    
        //bindeo el id
        $stmt->bindParam(1, $this->id);
    
        //ejecuto el query
        $stmt->execute();
    
        return $stmt;
    }

    function editar() {

    }

    function eliminar() {
        bajarOrden()

        //updato los orden
        $query = "DELETE " . $this->nombre_tabla . "
        SET orden = orden - 1                
        WHERE orden > ?";

        //preparo the query
        $stmt = $this->con->prepare($query);

        //sanitizo
        $this->orden=htmlspecialchars(strip_tags($this->orden));

        //bindeo el id
        $stmt->bindParam(1, $this->orden);

        //ejecuto el query
        if($stmt->execute()) {
        return true;
        }
        else {
        //echo $stmt->error;
        print_r($stmt->errorInfo());
        return false;
        }
    }

}

?>