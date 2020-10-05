<?php

class Configuracion {

    // onexión a la base y nombre de tabla
    private $con;
    private $nombre_tabla = "configuracion";

    //propiedades del objeto
    public $empresa;
    public $url;
    public $url_catalogo;
    public $mensaje;
    public $direccion;
    public $localidad;
    public $telefono;
    public $portada;
    public $logo;
    public $whatsapp;

    //constructor
    public function __construct($db){
        $this->con = $db;
    }

    function traer() {
        //traigo todo
        $query = "SELECT empresa, url, url_catalogo, mensaje, direccion, localidad, telefono, portada, logo, whatsapp
                FROM " . $this->nombre_tabla ;
    
        //preparo the query
        $stmt = $this->con->prepare($query);

    
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

                $this->empresa = $empresa;
                $this->url = $url;
                $this->url_catalogo = $url_catalogo;
                $this->mensaje = $mensaje;
                $this->direccion = $direccion;
                $this->localidad = $localidad;
                $this->telefono = $telefono;
                $this->portada = $portada;
                $this->logo = $logo;
                $this->whatsapp = $whatsapp;         
          
            }

            return true;

        }
        else {

            return false;

        }

    }

    function editar() {
        //insertar página
        $query = "UPDATE " . $this->nombre_tabla . "
        SET
            empresa = :empresa,
            url = :url,   
            url_catalogo = :url_catalogo,         
            mensaje = :mensaje,
            direccion = :direccion,
            localidad = :localidad,
            telefono = :telefono,
            whatsapp = :whatsapp";

        //preparo la query
        $stmt = $this->con->prepare($query);

        //le saco los tags, etc
        $this->empresa=htmlspecialchars(strip_tags($this->empresa));
        $this->url=htmlspecialchars(strip_tags($this->url));
        $this->url_catalogo=htmlspecialchars(strip_tags($this->url_catalogo));
        $this->mensaje=htmlspecialchars(strip_tags($this->mensaje));
        $this->direccion=htmlspecialchars(strip_tags($this->direccion));
        $this->localidad=htmlspecialchars(strip_tags($this->localidad));
        $this->telefono=htmlspecialchars(strip_tags($this->telefono));
        $this->whatsapp=htmlspecialchars(strip_tags($this->whatsapp));

        //bindeo los parámetros
        $stmt->bindParam(':empresa', $this->empresa);
        $stmt->bindParam(':url', $this->url);
        $stmt->bindParam(':url_catalogo', $this->url_catalogo);
        $stmt->bindParam(':mensaje', $this->mensaje);
        $stmt->bindParam(':direccion', $this->direccion);
        $stmt->bindParam(':localidad', $this->localidad);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':whatsapp', $this->whatsapp);

        //ejecuto el query y devuelvo true si salió todo bien
        if($stmt->execute()){
            return true;
        }

        //echo $stmt->error;
        print_r($stmt->errorInfo());

        return false;
    }


}

?>