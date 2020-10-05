<?php

if(!isset($_GET["id"])) {
    header('Location: usuario_controlador.php?accion=ver_todas');
}

// files needed to connect to database
include_once 'config/base-datos.php';
include_once 'objetos/usuario.php';
  
// instantiate database and product object
$database = new BaseDatos();
$db = $database->traerConexion();
  
// initialize object
$usu = new Usuario($db);
  
// query products
// $stmt = $usu->traerUno($_GET["id"]);
// $num = $stmt->rowCount();

if(!$usu->traerUno($_GET["id"])) {
    header('Location: usuario_controlador.php?accion=ver_todas');
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
                        <h1 class="mt-4">Vendedor</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item inactive"><a href="usuario_controlador.php?accion=ver_todas">Vendedores</a></li>
                            <li class="breadcrumb-item active">Ver</li>
                        </ol>

                        <div class="card mb-4">
                         <?php
                        // if(isset($usuinas_arr)){
                        //     foreach ($usuinas_arr as $usu){
                        ?> 
                            <div class="card-header d-flex w-100 justify-content-between mb2">                                
                                <div class="p-2"><i class="fas fa-user-alt"></i> Usuario</div>
                                <div>
                                    <?php
                                    if($usu->admin == 0) {
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
                                                <div class="col">
                                                    <h5 class="mb-1">
                                                        <?php echo $usu->nombre . " " . $usu->apellido; ?>
                                                    </h5>
                                                    <p class="mb-1"><strong>Usuario: </strong><?php echo $usu->usuario; ?></p>
                                                    <p class="mb-1"><strong>Nombre: </strong><?php echo $usu->nombre; ?></p>
                                                    <p class="mb-1"><strong>Apellido: </strong><?php echo $usu->apellido; ?></p>
                                                    <p class="mb-1"><strong>Administrador: </strong><?php echo $usu->admin == 1 ? "Sí" : "No"; ?></p>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Seguro que desea eliminar este usuario?
                                    </div>
                                    <div class="modal-footer">
                                    <form action="usuario_controlador.php" method="POST" enctype="multipart/form-data">
                                        <input type='hidden' name='eliminar' value='eliminar'>
                                        <input type='hidden' name='usuario' value='<?php echo $usu->usuario; ?>'>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
                                    </form>
                                    
                                    <!-- <a href="usuario_controlador.php?accion=e&id=<?php echo $usu->id; ?>" class="btn btn-danger">Eliminar Página</a> -->
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
