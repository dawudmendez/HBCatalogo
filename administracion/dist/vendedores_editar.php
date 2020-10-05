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

<?php require_once("head.php"); ?>
<?php
//$_SESSION["message"] = "Algo";  
?>
    <body class="sb-nav-fixed">
        <?php
        // if(isset($_SESSION["message"])) {
        //     if(!empty($_SESSION["message"])) {
            ?>
            <!-- <div class="alert alert-success" role="alert">
                This is a success alert—check it out!
            </div> -->
            <?php
        //     }
        // }
        ?>
        <?php require_once("top-nav.php"); ?>
        <div id="layoutSidenav">
            <?php require_once("side-nav.php"); ?>            
            <div id="layoutSidenav_content">
                <main>                    
                    <div class="container-fluid">
                        <?php require_once("alerts.php"); ?>
                        <h1 class="mt-4">Editar Vendedor</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item inactive"><a href="vendedor_controlador.php?accion=ver_todas">Vendedores</a></li>
                            <li class="breadcrumb-item active">Editar</li>
                        </ol>
                        
                        <div id="accordion">
                            <form id="form_vend" action="vendedor_controlador.php" method="POST" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-header text-white bg-primary" id="headingOne">
                                    <div class="p-2"><i class="fas fa-hand-holding-usd"></i> Datos del vendedor</div>
                                </div>

                                <div id="collapsePag" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">    
                                    <input type='hidden' name='editar' value='editar'>   
                                    <input type='hidden' name='id' value='<?php echo $vend->id; ?>'>

                                    <div class="form-group">
                                        <label for="pag_nombre">Usuario</label>
                                        <input type="text" class="form-control" readonly id="usuario" name="usuario" maxlength="50" aria-describedby="usuario_help" value="<?php echo $vend->usuario; ?>">
                                        <small id="usuario_help" class="form-text text-muted">El nombre de usuario no se puede modificar</small>
                                    </div>              
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" maxlength="50" aria-describedby="nombre_error" value="<?php echo $vend->nombre; ?>">
                                        <small id="nombre_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="l">Apellido</label>
                                        <input type="text" class="form-control" id="apellido" name="apellido" maxlength="50" aria-describedby="apellido_error" value="<?php echo $vend->apellido; ?>">
                                        <small id="apellido_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-email">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" maxlength="50" aria-describedby="email_error" value="<?php echo $vend->email; ?>">
                                        <small id="email_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="whatsapp">Whatsapp</label>
                                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" pattern="[0-9_+]{1,15}" maxlength="15" aria-describedby="whatsapp_help" value="<?php echo $vend->whatsapp; ?>">
                                        <small id="whatsapp_help" class="form-text text-muted">Código de país, 9, código de provincia, número. Ejemplo: +5491198761234</small>
                                        <small id="whatsapp_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <!-- <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="pag_visible" name="pag_visible" <?php echo ($vend->visible == 1 ? "checked" : ""); ?>>
                                        <label class="form-check-label" for="pag_visible">Visible</label>
                                    </div>   -->
                                    <a href="#" id="btn_submit" class="btn btn-success">Guardar</a>
                                </div>
                                </div>
                            </div>                            
                            </form>
                        </div>

                    </div>
                </main>
                <?php require_once("footer.php"); ?>
            </div>
        </div>
        <?php require_once("scripts.php"); ?>
        <script>
            $(document).ready(function(){
                
                function validarVendedor() {

                    limpiarErrores()                      

                    let validado = true; 

                    if($("#nombre").val() == null || $("#nombre").val() == '') {
                        $("#nombre_error").text("Este campo es obligatorio");
                        $("#nombre_error").show();
                        validado = false;
                    }

                    if($("#nombre").val().length > 50) {
                        $("#nombre_error").text("El nombre no debe exceder los 50 caracteres");
                        $("#nombre_error").show();
                        validado = false;
                    }

                    if($("#apellido").val() == null || $("#apellido").val() == '') {
                        $("#apellido_error").text("Este campo es obligatorio");
                        $("#apellido_error").show();
                        validado = false;
                    }

                    if($("#apellido").val().length > 50) {
                        $("#apellido_error").text("El apellido no debe exceder los 50 caracteres");
                        $("#apellido_error").show();
                        validado = false;
                    }

                    if($("#email").val().indexOf('@', 0) == -1 || $("#email").val().indexOf('.', 0) == -1) {
                        $("#email_error").text("Ingrese un email válido");
                        $("#email_error").show();
                        validado = false;
                    }

                    if($("#email").val() == null || $("#email").val() == '') {
                        $("#email_error").text("Este campo es obligatorio");
                        $("#email_error").show();
                        validado = false;
                    }

                    if($("#email").val().length > 50) {
                        $("#email_error").text("El email no debe exceder los 50 caracteres");
                        $("#email_error").show();
                        validado = false;
                    }

                    let phoneno = new RegExp('^\\+?([0-9]{1,14})$');
                    if(!phoneno.test($("#whatsapp").val())) {
                        $("#whatsapp_error").text("Ingrese un número válido");
                        $("#whatsapp_error").show();
                        validado = false;
                    }

                    if($("#whatsapp").val().indexOf('+', 0) == -1 || $("#whatsapp").val().indexOf('9', 0) == -1 ) {
                        $("#whatsapp_error").text("Ingrese un número válido");
                        $("#whatsapp_error").show();
                        validado = false;
                    }

                    if($("#whatsapp").val() == null || $("#whatsapp").val() == '') {
                        $("#whatsapp_error").text("Este campo es obligatorio");
                        $("#whatsapp_error").show();
                        validado = false;
                    }

                    if($("#whatsapp").val().length > 15) {
                        $("#whatsapp_error").text("El número de WhatsApp no debe exceder los 15 caracteres");
                        $("#whatsapp_error").show();
                        validado = false;
                    }

                    return validado;

                }

                function limpiarErrores() {
                $(".input_error").text("");
                $(".input_error").hide();
                }

                $("#btn_submit").click(function(){
                if(validarVendedor()) {
                    $("#form_vend").submit()
                }
                });

            }); 
        </script>
        <!-- <script src="scripts/paginas.js"></script> -->
    </body>
</html>