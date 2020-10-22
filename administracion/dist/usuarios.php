<?php require_once("session.php"); ?>
<?php require_once("acceso_admin.php"); ?>
<?php require_once("head.php"); ?>
<?php
 
// files needed to connect to database
include_once 'config/base-datos.php';
include_once 'objetos/usuario.php';
  
// instantiate database and product object
$database = new BaseDatos();
$db = $database->traerConexion();
  
// initialize object
$usu = new Usuario($db);
  
// query products
$stmt = $usu->traer();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){  
    // products array
    $usuedores_arr=array();
    //$usuedores_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $usuedores_item=array(
            "usuario" => $usuario,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "admin" => $admin
        );
  
        array_push($usuedores_arr, $usuedores_item);
    }
  
}

?>
    <body class="sb-nav-fixed">
        <?php require_once("top-nav.php"); ?>
        <div id="layoutSidenav">
            <?php require_once("side-nav.php"); ?>
            <div id="layoutSidenav_content">
                <main>                    
                    <div class="container-fluid">
                        <?php require_once("alerts.php"); ?>
                        <h1 class="mt-4">Usuarios</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Usuarios</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header d-flex w-100 justify-content-between mb2">                                
                                <div class="p-2"><i class="fas fa-user-alt"></i> Usuarios</div>
                                <div>
                                    <a class="btn btn-primary" href="usuario_controlador.php?accion=crear" role="button">Agregar Usuario</a>
                                </div>                              
                            </div>
                            <div class="card-body">
                                <?php
                                if(isset($usuedores_arr)){
                                    ?>
                                    <div class="list-group sortable">
                                    <?php
                                    foreach ($usuedores_arr as $usu){
                                    ?>                                        
                                        <!-- <a href="usuario_controlador.php?accion=ver&id=<?php echo $usu["id"]; ?>" class="list-group-item list-group-item-action <?php echo ($usu["orden"]==1 ? "active": ""); ?>"> -->
                                        <a href="usuario_controlador.php?accion=ver&usuario=<?php echo $usu["usuario"]; ?>" class="list-group-item list-group-item-action">
                                        <!-- <div class="list-group-item list-group-item-action <?php //echo ($usu["orden"]==1 ? "bg-light": ""); ?>"> -->
                                            <div class="d-flex w-100 justify-content-between">
                                                <div class="">
                                                    <h5 class="mb-1">
                                                        <?php echo $usu["usuario"]; ?>
                                                    </h5>
                                                </div>
                                                <div class="">
                                                    <strong>Nombre Completo:</strong> <?php echo $usu["nombre"] . ' ' . $usu["apellido"]; ?>
                                                </div>
                                            </div>
                                                
                                            <div class="d-flex w-100 justify-content-between">   
                                                <div>
                                                    <strong>Administrador:</strong> <?php echo $usu["admin"] == 1 ? "Sí" : "No"; ?>
                                                </div>                                                   
                                                <div class="">
                                                    
                                                </div>                                          
                                            </div>
                                            
                                        </a>
                                        <!-- </div> -->

                                    <?php
                                    }
                                    ?>
                                    </div>
                                    <?php
                                }
                                else {
                                ?>
                                <h2>No hay usuarios en el sistema</h2>
                                <?php
                                }
                                
                                ?>                               
                            </div>
                        </div>
                    </div>
                </main>
                <?php require_once("footer.php"); ?>
            </div>
        </div>
        <?php require_once("scripts.php"); ?>
        <script>
            // $(document).ready(function(){
            //     $('.sortable').sortable({
            //         group: 'list-group',
            //         pullPlaceholder: false,
            //     });
            // });       
        </script>
    </body>
</html>
