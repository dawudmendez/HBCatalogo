<?php

 if(!isset($_GET["id"])) {
    header('Location: index.php');
}

// files needed to connect to database
include_once 'config/base-datos.php';
include_once 'objetos/pagina.php';
  
// instantiate database and product object
$database = new BaseDatos();
$db = $database->traerConexion();
  
// initialize object
$pag = new Pagina($db);
  
// query products
$stmt = $pag->traerUno($_GET["id"]);
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
            "cant_prod" => $cant_prod,
            "orden" => $orden,
            "visible" => $visible,
            "prod_1_cod" => $prod_1_cod,
            "prod_1_nom" => $prod_1_nom,
            "prod_1_des" => $prod_1_des,
            "prod_1_pre" => $prod_1_pre,
            "prod_2_cod" => $prod_2_cod,
            "prod_2_nom" => $prod_2_nom,
            "prod_2_des" => $prod_2_des,
            "prod_2_pre" => $prod_2_pre,
            "prod_3_cod" => $prod_3_cod,
            "prod_3_nom" => $prod_3_nom,
            "prod_3_des" => $prod_3_des,
            "prod_3_pre" => $prod_3_pre,
            "prod_4_cod" => $prod_4_cod,
            "prod_4_nom" => $prod_4_nom,
            "prod_4_des" => $prod_4_des,
            "prod_4_pre" => $prod_4_pre
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
                        <h1 class="mt-4">Páginas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Páginas</li>
                        </ol>

                        <div class="card mb-4">
                        <?php
                        if(isset($paginas_arr)){
                            foreach ($paginas_arr as $pag){
                        ?>
                            <div class="card-header d-flex w-100 justify-content-between mb2">                                
                                <div class="p-2"><i class="fas fa-book-open"></i> Páginas del Catálogo</div>
                                <div>
                                    <a class="btn btn-success" href="paginas_crear.php" role="button">Editar</a>
                                    <?php
                                        if($pag["orden"] != 1) {
                                    ?>
                                        <a class="btn btn-danger" id="eliminar_btn" href="#" data-toggle="modal" data-target="#eliminar_modal">Eliminar</a>
                                    <?php
                                        }
                                    ?>                                    
                                </div>                                
                            </div>
                            <div class="card-body">                                
                                    <div class="list-group sortable">                                                                               
                                        <div class="list-group-item list-group-item-action">
                                            <div class="container">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h5 class="mb-1">
                                                        <?php echo $pag["nombre"]; ?>
                                                    </h5>
                                                    <p class="mb-1"><strong>Descripción: </strong><?php echo $pag["descripcion"]; ?></p>
                                                    <p class="mb-1"><strong>Visible: </strong><?php echo ($pag["visible"] == 1 ? "Sí" : "No"); ?></p>
                                                    <p class="mb-1"><strong>Número de página: </strong><?php echo $pag["orden"]; ?></p>
                                                    </br>
                                                    <?php
                                                        if($pag["cant_prod"] == 2 || $pag["cant_prod"] == 4) {
                                                    ?>
                                                    <div>
                                                        <h6>Producto 1</h6>
                                                        <p class="mb-1"><strong>Código: </strong><?php echo $pag["prod_1_cod"]; ?></p>
                                                        <p class="mb-1"><strong>Nombre: </strong><?php echo $pag["prod_1_nom"]; ?></p>
                                                        <p class="mb-1"><strong>Descripción: </strong><?php echo $pag["prod_1_des"]; ?></p>
                                                        <p class="mb-1"><strong>Precio: </strong><?php echo $pag["prod_1_pre"]; ?></p>
                                                        </br>
                                                        <h6>Producto 2</h6>
                                                        <p class="mb-1"><strong>Código: </strong><?php echo $pag["prod_2_cod"]; ?></p>
                                                        <p class="mb-1"><strong>Nombre: </strong><?php echo $pag["prod_2_nom"]; ?></p>
                                                        <p class="mb-1"><strong>Descripción: </strong><?php echo $pag["prod_2_des"]; ?></p>
                                                        <p class="mb-1"><strong>Precio: </strong><?php echo $pag["prod_2_pre"]; ?></p>
                                                    </div>
                                                    <?php
                                                        }

                                                        if($pag["cant_prod"] == 4) {
                                                    ?>
                                                    <div>
                                                        <h6>Producto 3</h6>
                                                        <p class="mb-1"><strong>Código: </strong><?php echo $pag["prod_3_cod"]; ?></p>
                                                        <p class="mb-1"><strong>Nombre: </strong><?php echo $pag["prod_3_nom"]; ?></p>
                                                        <p class="mb-1"><strong>Descripción: </strong><?php echo $pag["prod_3_des"]; ?></p>
                                                        <p class="mb-1"><strong>Precio: </strong><?php echo $pag["prod_3_pre"]; ?></p>
                                                        </br>
                                                        <h6>Producto 4</h6>
                                                        <p class="mb-1"><strong>Código: </strong><?php echo $pag["prod_4_cod"]; ?></p>
                                                        <p class="mb-1"><strong>Nombre: </strong><?php echo $pag["prod_4_nom"]; ?></p>
                                                        <p class="mb-1"><strong>Descripción: </strong><?php echo $pag["prod_4_des"]; ?></p>
                                                        <p class="mb-1"><strong>Precio: </strong><?php echo $pag["prod_4_pre"]; ?></p>
                                                    </div>  
                                                    <?php
                                                        }
                                                    ?>                                                  
                                                </div>
                                                <div class="col-sm-7">
                                                    <img src="<?php echo $pag["imagen"]; ?>" class="img-responsive" width="100%">
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>                                                          
                            </div>
                             
                            <!-- Eliminar página -->
                            <div class="modal fade" id="eliminar_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar página</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Seguro que desea eliminar esta página?
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <a href="admin_pagina.php?accion=e&id=<?php echo $pag["id"]; ?>" class="btn btn-danger">Eliminar Página</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <?php
                            }
                        }
                        else {
                        ?>
                            <h2>No hay páginas creadas</h2>
                        <?php
                        }                                
                        ?>  
                        </div>
                    </div>

                </main>
                <?php require_once("footer.php"); ?>
            </div>
        </div>
        <?php require_once("scripts.php"); ?>
        <script>
            $(document).ready(function(){
                
            });       
        </script>
    </body>
</html>
