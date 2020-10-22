<?php require_once("session.php"); ?>
<?php require_once("head.php"); ?>
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
// $stmt = $pag->traerUno($_GET["id"]);
// $num = $stmt->rowCount();

if(!$pag->traerUno($_GET["id"])) {
    header('Location: index.php');
}

?>

    <body class="sb-nav-fixed">
        <?php require_once("top-nav.php"); ?>
        <div id="layoutSidenav">
            <?php require_once("side-nav.php"); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Páginas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item inactive"><a href="pagina_controlador.php?accion=ver_todas">Páginas</a></li>
                            <li class="breadcrumb-item active">Ver</li>
                        </ol>

                        <div class="card mb-4">
                         <?php
                        // if(isset($paginas_arr)){
                        //     foreach ($paginas_arr as $pag){
                        ?> 
                            <div class="card-header d-flex w-100 justify-content-between mb2">                                
                                <div class="p-2"><i class="fas fa-book-open"></i> Páginas del Catálogo</div>
                                <div>
                                    <a class="btn btn-success" href="pagina_controlador.php?accion=editar&id=<?php echo $pag->id; ?>" role="button">Editar</a>
                                    <a class="btn btn-danger" id="eliminar_btn" href="#" data-toggle="modal" data-target="#eliminar_modal">Eliminar</a>
                                </div>                                
                            </div>
                            <div class="card-body">                                
                                    <div class="list-group sortable">                                                                               
                                        <div class="list-group-item list-group-item-action">
                                            <div class="container">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h5 class="mb-1">
                                                        <?php echo $pag->nombre; ?>
                                                    </h5>
                                                    <p class="mb-1"><strong>Descripción: </strong><?php echo $pag->descripcion; ?></p>
                                                    <!-- <p class="mb-1"><strong>Visible: </strong><?php //echo ($pag->visible == 1 ? "Sí" : "No"); ?></p> -->
                                                    <p class="mb-1"><strong>Número de página: </strong><?php echo $pag->orden; ?></p>
                                                    </br>
                                                    <?php
                                                        if($pag->cant_prod == 2 || $pag->cant_prod == 4) {
                                                    ?>
                                                    <div>
                                                        <h6>Producto 1</h6>
                                                        <p class="mb-1"><strong>Código: </strong><?php echo $pag->prod_1_cod; ?></p>
                                                        <p class="mb-1"><strong>Nombre: </strong><?php echo $pag->prod_1_nom; ?></p>
                                                        <p class="mb-1"><strong>Descripción: </strong><?php echo $pag->prod_1_des; ?></p>
                                                        <p class="mb-1"><strong>Precio: </strong><?php echo $pag->prod_1_pre; ?></p>
                                                        </br>
                                                        <h6>Producto 2</h6>
                                                        <p class="mb-1"><strong>Código: </strong><?php echo $pag->prod_2_cod; ?></p>
                                                        <p class="mb-1"><strong>Nombre: </strong><?php echo $pag->prod_2_nom; ?></p>
                                                        <p class="mb-1"><strong>Descripción: </strong><?php echo $pag->prod_2_des; ?></p>
                                                        <p class="mb-1"><strong>Precio: </strong><?php echo $pag->prod_2_pre; ?></p>
                                                    </div>
                                                    <?php
                                                        }

                                                        if($pag->cant_prod == 4) {
                                                    ?>
                                                    </br>
                                                    <div>
                                                        <h6>Producto 3</h6>
                                                        <p class="mb-1"><strong>Código: </strong><?php echo $pag->prod_3_cod; ?></p>
                                                        <p class="mb-1"><strong>Nombre: </strong><?php echo $pag->prod_3_nom; ?></p>
                                                        <p class="mb-1"><strong>Descripción: </strong><?php echo $pag->prod_3_des; ?></p>
                                                        <p class="mb-1"><strong>Precio: </strong><?php echo $pag->prod_3_pre; ?></p>
                                                        </br>
                                                        <h6>Producto 4</h6>
                                                        <p class="mb-1"><strong>Código: </strong><?php echo $pag->prod_4_cod; ?></p>
                                                        <p class="mb-1"><strong>Nombre: </strong><?php echo $pag->prod_4_nom; ?></p>
                                                        <p class="mb-1"><strong>Descripción: </strong><?php echo $pag->prod_4_des; ?></p>
                                                        <p class="mb-1"><strong>Precio: </strong><?php echo $pag->prod_4_pre; ?></p>
                                                    </div>  
                                                    <?php
                                                        }
                                                    ?>                                                  
                                                </div>
                                                <div class="col-sm-7">
                                                    <img src="<?php echo $pag->imagen; ?>" class="img-responsive" width="100%">
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
                                    <form action="pagina_controlador.php" method="POST" enctype="multipart/form-data">
                                        <input type='hidden' name='eliminar' value='eliminar'>
                                        <input type='hidden' name='id' value='<?php echo $pag->id; ?>'>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar Página</button>
                                    </form>
                                    
                                    <!-- <a href="pagina_controlador.php?accion=e&id=<?php echo $pag->id; ?>" class="btn btn-danger">Eliminar Página</a> -->
                                    </div>
                                </div>
                                </div>
                            </div>
                            <?php
                            //}
                        // }
                        // else {
                         ?>
                             <!-- <h2>No hay páginas creadas</h2> -->
                         <?php
                        // }                                
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
