<?php

// files needed to connect to database
include_once 'config/base-datos.php';
include_once 'objetos/configuracion.php';
  
// instantiate database and product object
$database = new BaseDatos();
$db = $database->traerConexion();
  
// initialize object
$conf = new Configuracion($db);
  
// query products
// $stmt = $conf->traerUno($_GET["id"]);
// $num = $stmt->rowCount();

if(!$conf->traer()) {
    header('Location: index.php');
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
                        <h1 class="mt-4">Configuración</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Configuración</li>
                        </ol>

                        <div class="card mb-4">
                         <?php
                        // if(isset($confinas_arr)){
                        //     foreach ($confinas_arr as $conf){
                        ?> 
                            <div class="card-header d-flex w-100 justify-content-between mb2">                                
                                <div class="p-2"><i class="fas fa-tachometer-alt"></i> Configuración del Catálogo</div>
                                <div>
                                    <a class="btn btn-success" href="configuracion_controlador.php?accion=editar" role="button">Editar</a>
                                </div>                                
                            </div>
                            <div class="card-body">                                
                                    <div class="list-group sortable">                                                                               
                                        <div class="list-group-item list-group-item-action">
                                            <div class="container">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h5 class="mb-1">
                                                        Datos de la empresa
                                                    </h5>
                                                    <p class="mb-1"><strong>Empresa: </strong><?php echo $conf->empresa; ?></p>
                                                    <p class="mb-1"><strong>URL: </strong><?php echo $conf->url; ?></p>
                                                    <p class="mb-1"><strong>URL Catalogo: </strong><?php echo $conf->url_catalogo; ?></p>
                                                    <p class="mb-1"><strong>Mensaje: </strong><?php echo $conf->mensaje; ?></p>
                                                    <p class="mb-1"><strong>Dirección: </strong><?php echo $conf->direccion; ?></p>
                                                    <p class="mb-1"><strong>Localidad: </strong><?php echo $conf->localidad; ?></p>
                                                    <p class="mb-1"><strong>Teléfono: </strong><?php echo $conf->telefono; ?></p>
                                                    <p class="mb-1"><strong>Whatsapp: </strong><?php echo $conf->whatsapp; ?></p>
                                                    </br> 
                                                    <h5 class="mb-1">
                                                        Logo
                                                    </h5>
                                                    <img src="<?php echo $conf->logo; ?>" class="img-responsive" width="100px">
                                                    </br>                                            
                                                </div>
                                                <div class="col-sm-7">
                                                    <img src="<?php echo $conf->portada; ?>" class="img-responsive" width="100%">
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>                                                          
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
                
            });       
        </script>
    </body>
</html>
