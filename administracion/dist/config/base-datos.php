<?php
// used to get mysql database connection
class BaseDatos{
 
    // specify your own database credentials
    private $host = "localhost";
    private $nombre_bd = "catalogo_online";
    private $nombre_usuario = "root";
    private $password = "";
    public $conn;
 
    // get the database connection
    public function traerConexion(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->nombre_bd, $this->nombre_usuario, $this->password);
        }
        catch(PDOException $exception){
            echo "Error de conexión: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>