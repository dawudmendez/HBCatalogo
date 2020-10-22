<?php

class Usuario {

    // onexión a la base y nombre de tabla
    private $con;
    private $nombre_tabla = "usuarios";

    //propiedades del objeto
    public $usuario;
    public $nombre;
    public $apellido;
    public $password;
    public $admin;

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
        $query = "SELECT usuario, nombre, apellido, password, admin
                FROM " . $this->nombre_tabla;
    
        //preparo la query
        $stmt = $this->con->prepare($query);
    
        //ejecuto la query
        $stmt->execute();
    
        return $stmt;
    }

    public function traerUno($usuario) {
        //traigo por id
        $query = "SELECT usuario, nombre, apellido, password, admin
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

                $this->usuario = $usuario;
                $this->nombre = $nombre;
                $this->apellido = $apellido;
                $this->password = $password;
                $this->admin = $admin;
          
            }

            return true;

        }
        else {

            return false;

        }
    }

    public function login($usuario) {
        //traigo por id
        $query = "SELECT usuario, nombre, apellido, password, admin
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

                $this->usuario = $usuario;
                $this->nombre = $nombre;
                $this->apellido = $apellido;
                $this->password = $password;
                $this->admin = $admin;
          
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

    public function crear() {
        //insertar página
        $query = "INSERT INTO " . $this->nombre_tabla . "
        SET
            usuario = :usuario,
            nombre = :nombre,
            apellido = :apellido,
            password = :password,
            admin = :admin
            ";

        //preparo la query
        $stmt = $this->con->prepare($query);

        //le saco los tags, etc
        $this->usuario=htmlspecialchars(strip_tags($this->usuario));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellido=htmlspecialchars(strip_tags($this->apellido));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->admin=htmlspecialchars(strip_tags($this->admin));

        //bindeo los parámetros
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':admin', $this->admin);

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
            nombre = :nombre,
            apellido = :apellido,
            password = :password,
            admin = :admin
            WHERE usuario = :usuario";

        //preparo la query
        $stmt = $this->con->prepare($query);

        //le saco los tags, etc
        $this->usuario=htmlspecialchars(strip_tags($this->usuario));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellido=htmlspecialchars(strip_tags($this->apellido));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->admin=htmlspecialchars(strip_tags($this->admin));

        //bindeo los parámetros
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':admin', $this->admin);

        //ejecuto el query y devuelvo true si salió todo bien
        if($stmt->execute()){
            return true;
        }

        //echo $stmt->error;
        print_r($stmt->errorInfo());

        return false;
    }

    public function eliminar($usuario) {
        //Query para borrar el registro
        $query = "DELETE from " . $this->nombre_tabla . "            
                WHERE usuario = ?";

        //Preparo la query
        $stmt = $this->con->prepare($query);

        //Sanitizo (se sacan caracteres especiales)
        $this->usuario=htmlspecialchars(strip_tags($usuario));

        //Bindeo - o mapeo - el id
        $stmt->bindParam(1, $this->usuario);

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