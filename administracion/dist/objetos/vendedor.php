<?php

class Vendedor {

    // onexión a la base y nombre de tabla
    private $con;
    private $nombre_tabla = "vendedores";

    //propiedades del objeto
    public $id;
    public $usuario;
    public $nombre;
    public $apellido;
    public $email;
    public $whatsapp;
    public $link;

    //constructor
    public function __construct($db){
        $this->con = $db;   
        $this->changeMode();     
    }

    function changeMode() {
        $query = "SET SESSION sql_mode = ''";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
    }

    public function traer() {
        //traigo todos
        $query = "SELECT id, usuario, nombre, apellido, email, whatsapp, link
                FROM " . $this->nombre_tabla;
    
        //preparo la query
        $stmt = $this->con->prepare($query);
    
        //ejecuto la query
        $stmt->execute();
    
        return $stmt;
    }

    public function traerUno($id) {
        //traigo por id
        $query = "SELECT id, usuario, nombre, apellido, email, whatsapp, link
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

        // query products
        $num = $stmt->rowCount();

        if($num>0){  
            // products array
            $paginas_arr=array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
          
                $this->id = $id;
                $this->usuario = $usuario;
                $this->nombre = $nombre;
                $this->apellido = $apellido;
                $this->email = $email;
                $this->whatsapp = $whatsapp;
                $this->link = $link;
          
            }

            return true;

        }
        else {

            return false;

        }
    }

    public function validarUsuario($usuario) {
        //traigo por id
        $query = "SELECT 1
                FROM " . $this->nombre_tabla . "
                WHERE usuario = ?";
    
        //preparo the query
        $stmt = $this->con->prepare($query);
    
        //sanitizo
        $this->usuario=htmlspecialchars(strip_tags($usuario));
    
        //bindeo el id
        $stmt->bindParam(1, $this->usuario);
    
        //ejecuto el query
        $stmt->execute();

        // query products
        $num = $stmt->rowCount();

        if($num>0){  
            return false;
        }
        else {
            return true;
        }
    }

    public function traerPorUsuario($usuario) {
        //traigo por id
        $query = "SELECT id, usuario, nombre, apellido, email, whatsapp, link
                FROM " . $this->nombre_tabla . "
                WHERE usuario = ?";
    
        //preparo the query
        $stmt = $this->con->prepare($query);
    
        //sanitizo
        $this->usuario=htmlspecialchars(strip_tags($usuario));
    
        //bindeo el id
        $stmt->bindParam(1, $this->usuario);
    
        //ejecuto el query
        $stmt->execute();

        // query products
        $num = $stmt->rowCount();

        if($num>0){  
            // products array
            $paginas_arr=array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
          
                $this->id = $id;
                $this->usuario = $usuario;
                $this->nombre = $nombre;
                $this->apellido = $apellido;
                $this->email = $email;
                $this->whatsapp = $whatsapp;
                $this->link = $link;
          
            }

            return true;

        }
        else {

            return false;

        }
    }

    public function crear() {
        //insertar página
        $query = "INSERT INTO " . $this->nombre_tabla . "
        SET
            usuario = :usuario,
            nombre = :nombre,
            apellido = :apellido,
            email = :email,
            whatsapp = :whatsapp,
            link = :link
            ";

        //preparo la query
        $stmt = $this->con->prepare($query);

        //le saco los tags, etc
        $this->usuario=htmlspecialchars(strip_tags($this->usuario));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellido=htmlspecialchars(strip_tags($this->apellido));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->whatsapp=htmlspecialchars(strip_tags($this->whatsapp));
        $this->link=htmlspecialchars(strip_tags($this->link));

        //bindeo los parámetros
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':whatsapp', $this->whatsapp);
        $stmt->bindParam(':link', $this->link);

        //ejecuto el query y devuelvo true si salió todo bien
        if($stmt->execute()){
            return true;
        }

        //echo $stmt->error;
        print_r($stmt->errorInfo());

        return false;
    }

    public function editar() {
        //insertar página
        $query = "UPDATE " . $this->nombre_tabla . "
        SET
            usuario = :usuario,
            nombre = :nombre,
            apellido = :apellido,
            email = :email,
            link = :link,
            whatsapp = :whatsapp
            WHERE id = :id";

        //preparo la query
        $stmt = $this->con->prepare($query);

        //le saco los tags, etc
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->usuario=htmlspecialchars(strip_tags($this->usuario));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellido=htmlspecialchars(strip_tags($this->apellido));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->whatsapp=htmlspecialchars(strip_tags($this->whatsapp));
        $this->link=htmlspecialchars(strip_tags($this->link));

        //bindeo los parámetros
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':whatsapp', $this->whatsapp);
        $stmt->bindParam(':link', $this->link);

        //ejecuto el query y devuelvo true si salió todo bien
        if($stmt->execute()){
            return true;
        }

        //echo $stmt->error;
        print_r($stmt->errorInfo());

        return false;
    }

    public function eliminar($id) {
        //Query para borrar el registro
        $query = "DELETE from " . $this->nombre_tabla . "            
                WHERE id = ?";

        //Preparo la query
        $stmt = $this->con->prepare($query);

        //Sanitizo (se sacan caracteres especiales)
        $this->id=htmlspecialchars(strip_tags($id));

        //Bindeo - o mapeo - el id
        $stmt->bindParam(1, $this->id);

        //Ejecuto el query
        if($stmt->execute()) {
            return true;
        }
        else {
            //echo $stmt->error;
            // print_r("Dentro de delete");
            // print_r($stmt->errorInfo());
            return false;
        }
    }

}

?>