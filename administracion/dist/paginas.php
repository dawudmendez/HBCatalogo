<?php
 
// files needed to connect to database
include_once 'config/base-datos.php';
include_once 'objetos/pagina.php';
  
// instantiate database and product object
$database = new BaseDatos();
$db = $database->traerConexion();
  
// initialize object
$pag = new Pagina($db);
  
// query products
$stmt = $pag->traer();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){  
    // products array
    $paginas_arr=array();
    //$paginas_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $paginas_item=array(
            "id" => $id,
            "nombre" => $nombre,
            "descripcion" => $descripcion,
            "imagen" => $imagen,
            "orden" => $orden,
        );
  
        array_push($paginas_arr, $paginas_item);
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
                        <h1 class="mt-4">Páginas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Páginas</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header d-flex w-100 justify-content-between mb2">                                
                                <div class="p-2"><i class="fas fa-book-open"></i> Páginas del Catálogo</div>
                                <div>
                                    <a class="btn btn-primary" href="pagina_controlador.php?accion=crear" role="button">Crear Página</a>
                                </div>                              
                            </div>
                            <div class="card-body">
                                <?php
                                if(isset($paginas_arr)){
                                    ?>
                                    <div class="list-group sortable">
                                    <?php
                                    foreach ($paginas_arr as $pag){
                                    ?>                                        
                                        <!-- <a href="pagina_controlador.php?accion=ver&id=<?php echo $pag["id"]; ?>" class="list-group-item list-group-item-action <?php echo ($pag["orden"]==1 ? "active": ""); ?>"> -->
                                        <a href="pagina_controlador.php?accion=ver&id=<?php echo $pag["id"]; ?>" class="list-group-item list-group-item-action">
                                        <!-- <div class="list-group-item list-group-item-action <?php //echo ($pag["orden"]==1 ? "bg-light": ""); ?>"> -->
                                            <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">
                                                <?php echo $pag["nombre"]; ?>
                                            </h5>
                                            <small>Número de página:</small>
                                            </div>
                                            <p class="mb-1"><?php echo $pag["descripcion"]; ?></p>
                                            <div class="d-flex justify-content-end">
                                                <span class="badge badge-primary badge-pill"><?php echo $pag["orden"]; ?></span>
                                            </div>
                                            <div class="">
                                            <!-- <a href="paginas_ver.php?id=<?php //echo $pag["id"]; ?>" class="btn btn-primary">Ver</a> 
                                            <a href="#" class="btn btn-success">Editar</a>  -->
                                            <!-- <a href="#" class="btn btn-danger">Eliminar</a> -->
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
                                <h2>No hay páginas creadas</h2>
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
            $(document).ready(function(){
                $('.sortable').sortable({
                    group: 'list-group',
                    pullPlaceholder: false,
                });
            });       
        </script>
    </body>
</html>
