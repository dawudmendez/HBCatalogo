<?php require_once("session.php"); ?>
<?php require_once("acceso_admin.php"); ?>
<?php require_once("head.php"); ?>
<?php

if(!isset($_GET["id"])) {
    header('Location: index.php');
}

// files needed to connect to database
include_once 'config/base-datos.php';
include_once 'objetos/vendedor.php';
  
// instantiate database and product object
$database = new BaseDatos();
$db = $database->traerConexion();
  
// initialize object
$vend = new Vendedor($db);
  
// query products
// $stmt = $vend->traerUno($_GET["id"]);
// $num = $stmt->rowCount();

if(!$vend->traerUno($_GET["id"])) {
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
                        <?php require_once("alerts.php"); ?>
                        <h1 class="mt-4">Vendedor</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item inactive"><a href="vendedor_controlador.php?accion=ver_todas">Vendedores</a></li>
                            <li class="breadcrumb-item active">Ver</li>
                        </ol>

                        <div class="card mb-4">
                         <?php
                        // if(isset($vendinas_arr)){
                        //     foreach ($vendinas_arr as $vend){
                        ?> 
                            <div class="card-header d-flex w-100 justify-content-between mb2">                                
                                <div class="p-2"><i class="fas fa-hand-holding-usd"></i> Vendedor</div>
                                <div>
                                    <a class="btn btn-success" href="vendedor_controlador.php?accion=editar&id=<?php echo $vend->id; ?>" role="button">Editar</a>
                                    <a class="btn btn-danger" id="eliminar_btn" href="#" data-toggle="modal" data-target="#eliminar_modal">Eliminar</a>
                                </div>                                
                            </div>
                            <div class="card-body">                                
                                    <div class="list-group sortable">                                                                               
                                        <div class="list-group-item list-group-item-action">
                                            <div class="container">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="mb-1">
                                                        <?php echo $vend->nombre . " " . $vend->apellido; ?>
                                                    </h5>
                                                    <p class="mb-1"><strong>Usuario: </strong><?php echo $vend->usuario; ?></p>
                                                    <p class="mb-1"><strong>Nombre: </strong><?php echo $vend->nombre; ?></p>
                                                    <p class="mb-1"><strong>Apellido: </strong><?php echo $vend->apellido; ?></p>
                                                    <p class="mb-1"><strong>Email: </strong><?php echo $vend->email; ?></p>
                                                    <p class="mb-1"><strong>Whatsapp: </strong><?php echo $vend->whatsapp; ?></p>
                                                    <p class="mb-1"><strong>Link: </strong><a href="<?php echo $vend->link; ?>" target="_blank"><?php echo $vend->link; ?></a></p>
                                                    </br>                                                                                                   
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>                                                          
                            </div>
                             
                            <!-- Eliminar vendedor -->
                            <div class="modal fade" id="eliminar_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar vendedor</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Seguro que desea eliminar este vendedor?
                                    </div>
                                    <div class="modal-footer">
                                    <form action="vendedor_controlador.php" method="POST" enctype="multipart/form-data">
                                        <input type='hidden' name='eliminar' value='eliminar'>
                                        <input type='hidden' name='id' value='<?php echo $vend->id; ?>'>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar Vendedor</button>
                                    </form>
                                    
                                    <!-- <a href="vendedor_controlador.php?accion=e&id=<?php echo $vend->id; ?>" class="btn btn-danger">Eliminar Página</a> -->
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
