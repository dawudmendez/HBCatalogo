<?php

// files needed to connect to database
include_once 'administracion/dist/config/base-datos.php';
include_once 'administracion/dist/objetos/configuracion.php';
include_once 'administracion/dist/objetos/vendedor.php';
include_once 'administracion/dist/objetos/pagina.php';

 
// instantiate database and product object
$database = new BaseDatos();
$db = $database->traerConexion();
  
// initialize object
$conf = new Configuracion($db);
$vend = new Vendedor($db);
$pag = new Pagina($db);

//Traigo la configuración
$conf->traer();

if(isset($_GET["vend"]) && $_GET["vend"] != "") {
    if($vend->traerPorUsuario($_GET["vend"])) {
        $whatsapp = $vend->whatsapp;
    }
    else {
        $whatsapp = $conf->whatsapp;
    }    
}
else {
    $whatsapp = $conf->whatsapp;
}
  
//Traigo las páginas
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
            "cant_prod" => $cant_prod,
            "orden" => $orden,
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css">
    <script src="src/bootstrap/js/bootstrap.min.js"></script>

    <link href="src/font-awesome/css/all.css" rel="stylesheet">

    <link rel="stylesheet" href="src/styles/styles.css">
    <script src="src/js/cart.js"></script>    

    <title>Home Basic - Catálogo</title>
    <link rel="icon" type="image/png" href="administracion/dist/<?php echo $_SESSION["logo"]; ?>">

</head>
<body>

    <div class="container-fluid px-0">
        <nav class="navbar navbar-expand-lg navbar navbar-light bg-light">
            <a class="navbar-brand" href="#"><img id="logo" src="<?php echo "administracion/dist/" . $conf->logo; ?>"></a>

            <span class="navbar-text">
                <i id="cart" class="fas fa-shopping-cart"> 0</i>                
            </span>
            
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>           
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" id="ver_carrito" href="#" data-toggle="modal" data-target="#ver_carrito_modal">Ver carrito <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="vaciar_carrito" href="#" data-toggle="modal" data-target="#vaciar_carrito_modal">Vaciar carrito</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contacto" href="#" data-toggle="modal" data-target="#contacto_modal">Contacto</a>
                    </li>
                </ul>                
            </div>
        </nav>
        

        <div id="carouselExampleControls" class="carousel slide" data-interval="false" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col img-div">
                            <img src="<?php echo "administracion/dist/" . $conf->portada; ?>" class="d-block w-100 img" alt="...">
                        </div>
                    </div>                    
                </div>

                <?php
                    if(isset($paginas_arr)){
                        foreach ($paginas_arr as $pag){
                ?>
                <div class="carousel-item">
                    <div class="row">
                        
                        <div class="col img-div">
                            <img src="<?php echo "administracion/dist/" . $pag["imagen"]; ?>" class="d-block w-100 img" alt="...">
                            <div class="dropup carousel-caption">
                                <?php
                                if($pag["cant_prod"] == 2 || $pag["cant_prod"] == 4) {
                                ?>                                
                                
                                <button class="btn btn-danger dropdown-toggle btn-carrito" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item btn-product" id="<?php echo $pag["prod_1_cod"]; ?>" precio="<?php echo $pag["prod_1_pre"]; ?>" nom="<?php echo $pag["prod_1_nom"]; ?>" desc="<?php echo $pag["prod_1_desc"]; ?>" href="#"><?php echo $pag["prod_1_nom"] . ": " . $pag["prod_1_pre"]; ?></a>
                                    <a class="dropdown-item btn-product" id="<?php echo $pag["prod_2_cod"]; ?>" precio="<?php echo $pag["prod_2_pre"]; ?>" nom="<?php echo $pag["prod_2_nom"]; ?>" desc="<?php echo $pag["prod_2_desc"]; ?>" href="#"><?php echo $pag["prod_2_nom"] . ": " . $pag["prod_2_pre"]; ?></a>
                                    <?php                                        
                                    if($pag["cant_prod"] == 4) {
                                    ?>
                                    <a class="dropdown-item btn-product" id="<?php echo $pag["prod_3_cod"]; ?>" precio="<?php echo $pag["prod_3_pre"]; ?>" nom="<?php echo $pag["prod_3_nom"]; ?>" desc="<?php echo $pag["prod_3_desc"]; ?>" href="#"><?php echo $pag["prod_3_nom"] . ": " . $pag["prod_3_pre"]; ?></a>
                                    <a class="dropdown-item btn-product" id="<?php echo $pag["prod_4_cod"]; ?>" precio="<?php echo $pag["prod_4_pre"]; ?>" nom="<?php echo $pag["prod_4_nom"]; ?>" desc="<?php echo $pag["prod_4_desc"]; ?>" href="#"><?php echo $pag["prod_4_nom"] . ": " . $pag["prod_4_pre"]; ?></a>
                                    <?php
                                    }
                                    ?>
                                </div>  
                                <?php
                                }
                                ?>  
                            </div>
                        </div>                        
                    </div>
                </div>
                <?php
                    }
                }
                ?>
                
            </div>        

            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
        
    </div>

    <!-- Modals -->
    <!-- Ver carrito -->
    <div class="modal fade" id="ver_carrito_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Carrito de compras</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" id="ver_carrito_modal_body">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <!-- <button type="button" class="btn btn-primary" id="enviar_carrito_btn" href="#">Enviar Carrito</button> -->
            <a href="#" class="btn btn-primary" target="_blank" id="enviar_carrito_btn">Enviar Carrito</a>
            </div>
        </div>
        </div>
    </div>

    <!-- Vaciar carrito -->
    <div class="modal fade" id="vaciar_carrito_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Vaciar carrito de compras</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" id="vaciar_carrito_modal_body">
                ¿Seguro que desea vaciar su carrito de compras?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="vaciar_carrito_btn">Vaciar Carrito</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Contacto -->
    <div class="modal fade" id="contacto_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Contacto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <strong><?php echo $conf->empresa; ?></strong></br>
                <a href="<?php echo $conf->url; ?>" target="_blank"><?php echo $conf->url; ?></a></br>
                <?php echo $conf->mensaje; ?></br>
                </br>
                <strong><?php echo $conf->direccion; ?></strong></br>
                <strong><?php echo $conf->localidad; ?></strong></br>
                <i class="fa fa-phone fa-flip-horizontal"></i> <strong><?php echo $conf->telefono; ?></strong></br>

                
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        </div>
    </div>

    <script>

        $( document ).ready(function() {

            $(".btn-product").click(function() {
                carro.AgregarProducto($(this).attr('id'), $(this).text(), $(this).attr('precio'));
                $("#cart").text(carro.productos_count);
            });


            $("#ver_carrito").click(function(){
                if(carro.productos_count == 0) {
                    $("#ver_carrito_modal_body").text("Su carrito de compras está vacío");
                    $("#enviar_carrito_btn").attr("href", "#");
                    $("#enviar_carrito_btn").hide();
                }
                else{
                    $("#ver_carrito_modal_body").html(carro.MostrarContenido());
                    var whatsapp_number = <?php echo $whatsapp; ?>;
                    var whatsapp_url = "https://api.whatsapp.com/send?phone=" + whatsapp_number + "&text=";
                    whatsapp_url += carro.GenerarMensaje();
                    $("#enviar_carrito_btn").attr("href", whatsapp_url);
                    $("#enviar_carrito_btn").show();
                }

            });

            $("#vaciar_carrito").click(function(){
                if(carro.productos_count == 0) {
                    $("#vaciar_carrito_modal_body").text("Su carrito de compras está vacío");
                    $("#vaciar_carrito_btn").hide();
                }
                else{
                    $("#vaciar_carrito_modal_body").html("¿Seguro que desea vaciar su carrito de compras?");
                    $("#vaciar_carrito_btn").show();
                }

            });

            $("#vaciar_carrito_btn").click(function(){
                carro.VaciarCarrito();
                $("#cart").text(carro.productos_count);
                alert("Carrito vaciado");
                $('#vaciar_carrito_modal').modal('hide')
            })
            
        });




    </script>
    
</body>
</html>