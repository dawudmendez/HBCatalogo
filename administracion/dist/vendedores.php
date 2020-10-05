<?php
 
// files needed to connect to database
include_once 'config/base-datos.php';
include_once 'objetos/vendedor.php';
  
// instantiate database and product object
$database = new BaseDatos();
$db = $database->traerConexion();
  
// initialize object
$vend = new Vendedor($db);
  
// query products
$stmt = $vend->traer();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){  
    // products array
    $vendedores_arr=array();
    //$vendedores_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $vendedores_item=array(
            "id" => $id,
            "usuario" => $usuario,
            "nombre" => $nombre,
            "apellido" => $apellido,
            "email" => $email,
            "whatsapp" => $whatsapp,
            "link" => $link
        );
  
        array_push($vendedores_arr, $vendedores_item);
    }
  
}

?>

<?php require_once("head.php"); ?>
    <body class="sb-nav-fixed">
        <?php require_once("top-nav.php"); ?>
        <div id="layoutSidenav">
            <?php require_once("side-nav.php"); ?>
            <div id="layoutSidenav_content">
                <main>                    
                    <div class="container-fluid">
                        <?php require_once("alerts.php"); ?>
                        <h1 class="mt-4">Vendedores</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Vendedores</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header d-flex w-100 justify-content-between mb2">                                
                                <div class="p-2"><i class="fas fa-user-alt"></i> Vendedores</div>
                                <div>
                                    <a class="btn btn-primary" href="vendedor_controlador.php?accion=crear" role="button">Agregar Vendedor</a>
                                </div>                              
                            </div>
                            <div class="card-body">
                                <?php
                                if(isset($vendedores_arr)){
                                    ?>
                                    <div class="list-group sortable">
                                    <?php
                                    foreach ($vendedores_arr as $vend){
                                    ?>                                        
                                        <!-- <a href="vendedor_controlador.php?accion=ver&id=<?php echo $vend["id"]; ?>" class="list-group-item list-group-item-action <?php echo ($vend["orden"]==1 ? "active": ""); ?>"> -->
                                        <a href="vendedor_controlador.php?accion=ver&id=<?php echo $vend["id"]; ?>" class="list-group-item list-group-item-action">
                                        <!-- <div class="list-group-item list-group-item-action <?php //echo ($vend["orden"]==1 ? "bg-light": ""); ?>"> -->
                                            <div class="d-flex w-100 justify-content-between">
                                                <div class="">
                                                    <h5 class="mb-1">
                                                        <?php echo $vend["nombre"] . ' ' . $vend["apellido"]; ?>
                                                    </h5>
                                                </div>
                                                <div class="">
                                                    <strong>Whatsapp:</strong> <?php echo $vend["whatsapp"]; ?>
                                                </div>
                                            </div>
                                                
                                            <div class="d-flex w-100 justify-content-between">   
                                                <div>
                                                    <strong>Usuario:</strong> <?php echo $vend["usuario"]; ?>
                                                </div>                                                   
                                                <div class="">
                                                    <strong>Link:</strong> <?php echo $vend["link"]; ?>
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
                                <h2>No hay vendedores en el sistema</h2>
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
