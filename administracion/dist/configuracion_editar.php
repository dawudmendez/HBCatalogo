<?php require_once("session.php"); ?>
<?php require_once("acceso_admin.php"); ?>
<?php require_once("head.php"); ?>
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
                        <h1 class="mt-4">Editar Configuración</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Configuración</li>
                        </ol>
                        
                        <div id="accordion">
                            <form id="form_conf" action="configuracion_controlador.php" method="POST" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-header text-white bg-primary" id="headingOne">
                                    <div class="p-2"><i class="fas fa-tachometer-alt"></i> Configuración del sitio</div>
                                </div>

                                <div id="collapsePag" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">    
                                    <input type='hidden' name='editar' value='editar'>                
                                    <div class="form-group">
                                        <label for="empresa">Empresa</label>
                                        <input type="text" class="form-control" id="empresa" name="empresa" maxlength="50" aria-describedby="empresa_error" value="<?php echo $conf->empresa; ?>">
                                        <small id="empresa_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="url">URL</label>
                                        <input type="text" class="form-control" id="url" name="url" maxlength="150" aria-describedby="url_error" value="<?php echo $conf->url; ?>">
                                        <small id="url_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="url_catalogo">URL Catalogo</label>
                                        <input type="text" class="form-control" id="url_catalogo" name="url_catalogo" maxlength="150" aria-describedby="url_catalogo_error" value="<?php echo $conf->url_catalogo; ?>">
                                        <small id="url_catalogo_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="mensaje">Mensaje</label>
                                        <input type="text" class="form-control" id="mensaje" name="mensaje" maxlength="50" aria-describedby="mensaje_error" value="<?php echo $conf->mensaje; ?>">
                                        <small id="mensaje_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion" maxlength="150" aria-describedby="direccion_error" value="<?php echo $conf->direccion; ?>">
                                        <small id="direccion_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="localidad">Localidad</label>
                                        <input type="text" class="form-control" id="localidad" name="localidad" maxlength="50" aria-describedby="localidad_error" value="<?php echo $conf->localidad; ?>">
                                        <small id="localidad_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" maxlength="150" aria-describedby="telefono_error" value="<?php echo $conf->telefono; ?>">
                                        <small id="telefono_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-group" id="input_imagen_propia">
                                        <label for="portada">Portada</label>
                                        <input type="file" class="form-control-file" id="portada" name="portada" aria-describedby="portada_error" accept="image/*"/>
                                        <small id="portada_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-group" id="input_imagen_propia">
                                        <label for="logo">Logo</label>
                                        <input type="file" class="form-control-file" id="logo" name="logo" aria-describedby="logo_error" accept="image/*"/>
                                        <small id="logo_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="whatsapp">Whatsapp</label>
                                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" maxlength="15" aria-describedby="whatsapp_error" value="<?php echo $conf->whatsapp; ?>">
                                        <small id="whatsapp_help" class="form-text text-muted">Código de país, 9, código de provincia, número. Ejemplo: +5491198761234</small>
                                        <small id="whatsapp_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    
                                    <!-- <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="pag_visible" name="pag_visible" <?php echo ($conf->visible == 1 ? "checked" : ""); ?>>
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

                function validarConfiguracion() {

                    limpiarErrores()                      

                    let validado = true; 

                    if($("#empresa").val() == null || $("#empresa").val() == '') {
                        $("#empresa_error").text("Este campo es obligatorio");
                        $("#empresa_error").show();
                        validado = false;
                    }

                    if($("#empresa").val().length > 50) {
                        $("#empresa_error").text("El nombre de la empresa no debe exceder los 50 caracteres");
                        $("#empresa_error").show();
                        validado = false;
                    }

                    if($("#url").val() == null || $("#url").val() == '') {
                        $("#url_error").text("Este campo es obligatorio");
                        $("#url_error").show();
                        validado = false;
                    }
                    else if($("#url").val().substring(0,7) != "http://" && $("#url").val().substring(0,8) != "https://") {
                        $("#url_error").text("Ingrese una URL válida");
                        $("#url_error").show();
                        validado = false;
                    }

                    if($("#url").val().length > 150) {
                        $("#url_error").text("La URL no debe exceder los 150 caracteres");
                        $("#url_error").show();
                        validado = false;
                    }

                    if($("#url_catalogo").val() == null || $("#url_catalogo").val() == '') {
                        $("#url_catalogo_error").text("Este campo es obligatorio");
                        $("#url_catalogo_error").show();
                        validado = false;
                    }
                    else if($("#url_catalogo").val().substring(0,7) != "http://" && $("#url_catalogo").val().substring(0,8) != "https://") {
                        $("#url_catalogo_error").text("Ingrese una URL válida");
                        $("#url_catalogo_error").show();
                        validado = false;
                    }                    

                    if($("#url_catalogo").val().length > 150) {
                        $("#url_catalogo_error").text("La URL del catálogo no debe exceder los 150 caracteres");
                        $("#url_catalogo_error").show();
                        validado = false;
                    }

                    if($("#mensaje").val() == null || $("#mensaje").val() == '') {
                        $("#mensaje_error").text("Este campo es obligatorio");
                        $("#mensaje_error").show();
                        validado = false;
                    }

                    if($("#mensaje").val().length > 50) {
                        $("#mensaje_error").text("El mensaje no debe exceder los 50 caracteres");
                        $("#mensaje_error").show();
                        validado = false;
                    }

                    if($("#direccion").val() == null || $("#direccion").val() == '') {
                        $("#direccion_error").text("Este campo es obligatorio");
                        $("#direccion_error").show();
                        validado = false;
                    }

                    if($("#direccion").val().length > 150) {
                        $("#direccion_error").text("La direccion no debe exceder los 150 caracteres");
                        $("#direccion_error").show();
                        validado = false;
                    }

                    if($("#localidad").val() == null || $("#localidad").val() == '') {
                        $("#localidad_error").text("Este campo es obligatorio");
                        $("#localidad_error").show();
                        validado = false;
                    }

                    if($("#localidad").val().length > 50) {
                        $("#localidad_error").text("El nombre no debe exceder los 50 caracteres");
                        $("#localidad_error").show();
                        validado = false;
                    }

                    if($("#telefono").val() == null || $("#telefono").val() == '') {
                        $("#telefono_error").text("Este campo es obligatorio");
                        $("#telefono_error").show();
                        validado = false;
                    }

                    if($("#telefono").val().length > 150) {
                        $("#telefono_error").text("El telefono no debe exceder los 150 caracteres");
                        $("#telefono_error").show();
                        validado = false;
                    }

                    let phoneno = new RegExp('^\\+?([0-9]{1,15})$');
                    if(!phoneno.test($("#whatsapp").val())) {
                        $("#whatsapp_error").text("Ingrese un número válido");
                        $("#whatsapp_error").show();
                        validado = false;
                    }

                    if($("#whatsapp").val().substring(0,4) != "+549") {
                        $("#whatsapp_error").text("Ingrese un número válido, con formato: +549");
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
                    if(validarConfiguracion()) {
                        $("#form_conf").submit()
                    }
                });

            }); 
        </script>
        <!-- <script src="scripts/paginas.js"></script> -->
    </body>
</html>