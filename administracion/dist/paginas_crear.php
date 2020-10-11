<?php require_once("head.php"); ?>
<?php


// files needed to connect to database
include_once 'config/base-datos.php';
include_once 'objetos/pagina.php';
  
// instantiate database and product object
$database = new BaseDatos();
$db = $database->traerConexion();
  
// initialize object
$pag = new Pagina($db);  

$maxorden = $pag->traerMaxOrden();

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
                        <h1 class="mt-4">Crear Página</h1>
                        <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item inactive"><a href="pagina_controlador.php?accion=ver_todas">Páginas</a></li>
                            <li class="breadcrumb-item active">Crear</li>
                        </ol>
                        
                        <div id="accordion">
                            <form id="form_pag" action="pagina_controlador.php" method="POST" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-header text-white bg-primary" id="headingOne">
                                    <div class="p-2"><i class="fas fa-book-open"></i> 1. Detalles de la página</div>
                                </div>

                                <div id="collapsePag" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">    
                                    <input type='hidden' name='insertar' value='insertar'>                        
                                    <div class="form-group">
                                        <label for="pag_nombre">Nombre</label>
                                        <input type="text" class="form-control" id="pag_nombre" name="pag_nombre" maxlength="50" placeholder="Ingrese un nombre que identifique a la página">
                                        <small id="pag_nombre_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="pag_descripcion">Descripción</label>
                                        <input type="text" class="form-control" id="pag_descripcion" name="pag_descripcion" maxlength="150" placeholder="Ingrese una descripción para la página">
                                        <small id="pag_descripcion_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-group" id="input_imagen_propia">
                                        <label for="pag_imagen">Imagen</label>
                                        <input type="file" class="form-control-file" id="pag_imagen" name="pag_imagen" accept="image/*"/>
                                        <small id="pag_imagen_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pag_tipo_radio" id="pag_tipo_radio_0" value="0" checked>
                                        <label class="form-check-label" for="pag_tipo_radio_0">Portada (sin productos)</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pag_tipo_radio" id="pag_tipo_radio_2" value="2">
                                        <label class="form-check-label" for="pag_tipo_radio_2">2 productos</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pag_tipo_radio" id="pag_tipo_radio_4" value="4">
                                        <label class="form-check-label" for="pag_tipo_radio_4">4 productos</label>
                                    </div>
                                    </br>
                                    <div class="form-group">
                                        <label for="pag_orden">Orden</label>
                                        <input type="number" class="form-control" id="pag_orden" name="pag_orden" min=1 max=<?php echo ($maxorden + 1); ?> value=<?php echo ($maxorden + 1); ?>>
                                        <small id="pag_orden_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <!-- <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="pag_visible" name="pag_visible">
                                        <label class="form-check-label" for="pag_visible">Visible</label>
                                    </div>   -->
                                    <a href="#" class="btn btn-primary" id="pag_siguiente">Siguiente</a>
                                </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">  
                                    <div class="p-2"><i class="fas fa-shopping-basket"></i> 2. Detalles de los productos</div>
                                </div>
                                <div id="collapseProd" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">

                                    <div class="row" id="prod_2_row">
                                        <div class="col-sm-6">
                                            <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Producto 1</h5>
                                                <div class="form-group">
                                                    <label for="prod_1_cod">Código</label>
                                                    <input type="text" class="form-control" id="prod_1_cod" name="prod_1_cod" maxlength="20">
                                                    <small id="prod_1_cod_error" class="form-text text-danger input_error"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_1_nom">Nombre</label>
                                                    <input type="text" class="form-control" id="prod_1_nom" name="prod_1_nom" maxlength="20">
                                                    <small id="prod_1_nom_error" class="form-text text-danger input_error"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_1_desc">Descripción</label>
                                                    <input type="text" class="form-control" id="prod_1_desc" name="prod_1_desc" maxlength="20">
                                                    <small id="prod_1_desc_error" class="form-text text-danger input_error"></small>
                                                </div> 
                                                <div class="form-group">
                                                    <label for="prod_1_pre">Precio</label>
                                                    <input type="number" min="0.00" step="0.01" value="0.00" class="form-control input_decimal" id="prod_1_pre" name="prod_1_pre" maxlength="20" pattern="^\d*(\.\d{0,2})?$">
                                                    <small id="prod_1_pre_error" class="form-text text-danger input_error"></small>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Producto 2</h5>
                                                <div class="form-group">
                                                    <label for="prod_2_cod">Código</label>
                                                    <input type="text" class="form-control" id="prod_2_cod" name="prod_2_cod" maxlength="20">
                                                    <small id="prod_2_cod_error" class="form-text text-danger input_error"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_2_nom">Nombre</label>
                                                    <input type="text" class="form-control" id="prod_2_nom" name="prod_2_nom" maxlength="20">
                                                    <small id="prod_2_nom_error" class="form-text text-danger input_error"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_2_desc">Descripción</label>
                                                    <input type="text" class="form-control" id="prod_2_desc" name="prod_2_desc" maxlength="20">
                                                    <small id="prod_2_desc_error" class="form-text text-danger input_error"></small>
                                                </div> 
                                                <div class="form-group">
                                                    <label for="prod_2_pre">Precio</label>
                                                    <input type="number" min="0.00" step="0.01" value="0.00" class="form-control input_decimal" id="prod_2_pre" name="prod_2_pre">
                                                    <small id="prod_2_pre_error" class="form-text text-danger input_error"></small>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="row" id="prod_4_row">
                                        <div class="col-sm-6">
                                            <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Producto 3</h5>
                                                <div class="form-group">
                                                    <label for="prod_3_cod">Código</label>
                                                    <input type="text" class="form-control" id="prod_3cod" name="prod_3_cod" maxlength="20">
                                                    <small id="prod_3_cod_error" class="form-text text-danger input_error"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_3_nom">Nombre</label>
                                                    <input type="text" class="form-control" id="prod_3_nom" name="prod_3_nom" maxlength="20">
                                                    <small id="prod_3_nom_error" class="form-text text-danger input_error"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_3_desc">Descripción</label>
                                                    <input type="text" class="form-control" id="prod_3_desc" name="prod_3_desc" maxlength="20">
                                                    <small id="prod_3_desc_error" class="form-text text-danger input_error"></small>
                                                </div> 
                                                <div class="form-group">
                                                    <label for="prod_3_pre">Precio</label>
                                                    <input type="number" min="0.00" step="0.01" value="0.00" class="form-control input_decimal" id="prod_3_pre" name="prod_3_pre">
                                                    <small id="prod_3_pre_error" class="form-text text-danger input_error"></small>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Producto 4</h5>
                                                <div class="form-group">
                                                    <label for="prod_4_cod">Código</label>
                                                    <input type="text" class="form-control" id="prod_4_cod" name="prod_4_cod" maxlength="20">
                                                    <small id="prod_4_cod_error" class="form-text text-danger input_error"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_4_nom">Nombre</label>
                                                    <input type="text" class="form-control" id="prod_4_nom" name="prod_4_nom" maxlength="20">
                                                    <small id="prod_4_nom_error" class="form-text text-danger input_error"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_4_desc">Descripción</label>
                                                    <input type="text" class="form-control" id="prod_4_desc" name="prod_4_desc" maxlength="20">
                                                    <small id="prod_4_desc_error" class="form-text text-danger input_error"></small>
                                                </div> 
                                                <div class="form-group">
                                                    <label for="prod_4_pre">Precio</label>
                                                    <input type="number" min="0.00" step="0.01" value="0.00" class="form-control input_decimal" id="prod_4_pre" name="prod_4_pre">
                                                    <small id="prod_4_pre_error" class="form-text text-danger input_error"></small>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    </br>
                                    <!-- <button type="submit" class="btn btn-success">Crear</button> -->
                                    <a href="#" id="btn_submit" class="btn btn-success">Crear</a> <a href="#" class="btn btn-light" id="prod_atras">Atrás</a>  
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
                $("#pag_prod_cant_div").hide();

                function ceroProd() {
                    $("#prod_2_row").hide();
                    $("#prod_4_row").hide();
                }

                function dosProd() {
                    $("#prod_2_row").show();
                    $("#prod_4_row").hide();
                }

                function cuatroProd() {
                    $("#prod_2_row").show();
                    $("#prod_4_row").show();
                }

                function validarPagina() {
                    limpiarErrores();

                    let validado = true;
                    
                    if($("#pag_nombre").val() == null || $("#pag_nombre").val() == '') {
                        $("#pag_nombre_error").text("Este campo es obligatorio");
                        $("#pag_nombre_error").show();
                        validado = false;
                    }

                    if($("#pag_nombre").val().length > 50) {
                        $("#pag_nombre_error").text("El nombre no debe exceder los 50 caracteres");
                        $("#pag_nombre_error").show();
                        validado = false;
                    }                    

                    if($("#pag_descripcion").val() == null || $("#pag_descripcion").val() == '') {
                        $("#pag_descripcion_error").text("Este campo es obligatorio");
                        $("#pag_descripcion_error").show();
                        validado = false;
                    }

                    if($("#pag_descripcion").val().length > 150) {
                        $("#pag_descripcion_error").text("La descripcion no debe exceder los 50 caracteres");
                        $("#pag_descripcion_error").show();
                        validado = false;
                    }

                    if($("#pag_imagen").val() == null || $("#pag_imagen").val() == '') {
                        $("#pag_imagen_error").text("Debe subir una imagen");
                        $("#pag_imagen_error").show();
                        validado = false;
                    }

                    if($("#pag_orden").val() > <?php echo ($maxorden + 1); ?>) {
                        $("#pag_orden_error").text("No debe ser mayor a <?php echo ($maxorden + 1); ?>");
                        $("#pag_orden_error").show();
                        validado = false;
                    }

                    if($("#pag_orden").val() < 1) {
                        $("#pag_orden_error").text("No debe ser menor a 1");
                        $("#pag_orden_error").show();
                        validado = false;
                    }

                    return validado;

                }

                function validarProd() {
                    limpiarErrores();

                    let validado = true;

                    if($("#pag_tipo_radio_2").is(':checked') || $("#pag_tipo_radio_4").is(':checked')) {

                        //PROD 1
                        if($("#prod_1_cod").val() == null || $("#prod_1_cod").val() == '') {
                            $("#prod_1_cod_error").text("Este campo es obligatorio");
                            $("#prod_1_cod_error").show();
                            validado = false;
                        }

                        if($("#prod_1_cod").val().length > 20) {
                            $("#prod_1_cod_error").text("El código no debe exceder los 20 caracteres");
                            $("#prod_1_cod_error").show();
                            validado = false;
                        }

                        if($("#prod_1_nom").val() == null || $("#prod_1_nom").val() == '') {
                            $("#prod_1_nom_error").text("Este campo es obligatorio");
                            $("#prod_1_nom_error").show();
                            validado = false;
                        }

                        if($("#prod_1_nom").val().length > 20) {
                            $("#prod_1_nom_error").text("El nombre no debe exceder los 20 caracteres");
                            $("#prod_1_nom_error").show();
                            validado = false;
                        }

                        if($("#prod_1_desc").val() == null || $("#prod_1_desc").val() == '') {
                            $("#prod_1_desc_error").text("Este campo es obligatorio");
                            $("#prod_1_desc_error").show();
                            validado = false;
                        }

                        if($("#prod_1_desc").val().length > 20) {
                            $("#prod_1_desc_error").text("La descripción no debe exceder los 20 caracteres");
                            $("#prod_1_desc_error").show();
                            validado = false;
                        }

                        //PROD 2
                        if($("#prod_2_cod").val() == null || $("#prod_2_cod").val() == '') {
                            $("#prod_2_cod_error").text("Este campo es obligatorio");
                            $("#prod_2_cod_error").show();
                            validado = false;
                        }

                        if($("#prod_2_cod").val().length > 20) {
                            $("#prod_2_cod_error").text("El código no debe exceder los 20 caracteres");
                            $("#prod_2_cod_error").show();
                            validado = false;
                        }

                        if($("#prod_2_nom").val() == null || $("#prod_2_nom").val() == '') {
                            $("#prod_2_nom_error").text("Este campo es obligatorio");
                            $("#prod_2_nom_error").show();
                            validado = false;
                        }

                        if($("#prod_2_nom").val().length > 20) {
                            $("#prod_2_nom_error").text("El nombre no debe exceder los 20 caracteres");
                            $("#prod_2_nom_error").show();
                            validado = false;
                        }

                        if($("#prod_2_desc").val() == null || $("#prod_2_desc").val() == '') {
                            $("#prod_2_desc_error").text("Este campo es obligatorio");
                            $("#prod_2_desc_error").show();
                            validado = false;
                        }

                        if($("#prod_2_desc").val().length > 20) {
                            $("#prod_2_desc_error").text("La descripción no debe exceder los 20 caracteres");
                            $("#prod_2_desc_error").show();
                            validado = false;
                        }

                    }
                    
                    if($("#pag_tipo_radio_4").is(':checked')) {
                        
                        //PROD 3
                        if($("#prod_3_cod").val() == null || $("#prod_3_cod").val() == '') {
                            $("#prod_3_cod_error").text("Este campo es obligatorio");
                            $("#prod_3_cod_error").show();
                            validado = false;
                        }

                        if($("#prod_3_cod").val().length > 20) {
                            $("#prod_3_cod_error").text("El código no debe exceder los 20 caracteres");
                            $("#prod_3_cod_error").show();
                            validado = false;
                        }

                        if($("#prod_3_nom").val() == null || $("#prod_3_nom").val() == '') {
                            $("#prod_3_nom_error").text("Este campo es obligatorio");
                            $("#prod_3_nom_error").show();
                            validado = false;
                        }

                        if($("#prod_3_nom").val().length > 20) {
                            $("#prod_3_nom_error").text("El nombre no debe exceder los 20 caracteres");
                            $("#prod_3_nom_error").show();
                            validado = false;
                        }

                        if($("#prod_3_desc").val() == null || $("#prod_3_desc").val() == '') {
                            $("#prod_3_desc_error").text("Este campo es obligatorio");
                            $("#prod_3_desc_error").show();
                            validado = false;
                        }

                        if($("#prod_3_desc").val().length > 20) {
                            $("#prod_3_desc_error").text("La descripción no debe exceder los 20 caracteres");
                            $("#prod_3_desc_error").show();
                            validado = false;
                        }

                        //PROD 4
                        if($("#prod_4_cod").val() == null || $("#prod_4_cod").val() == '') {
                            $("#prod_4_cod_error").text("Este campo es obligatorio");
                            $("#prod_4_cod_error").show();
                            validado = false;
                        }

                        if($("#prod_4_cod").val().length > 20) {
                            $("#prod_4_cod_error").text("El código no debe exceder los 20 caracteres");
                            $("#prod_4_cod_error").show();
                            validado = false;
                        }

                        if($("#prod_4_nom").val() == null || $("#prod_4_nom").val() == '') {
                            $("#prod_4_nom_error").text("Este campo es obligatorio");
                            $("#prod_4_nom_error").show();
                            validado = false;
                        }

                        if($("#prod_4_nom").val().length > 20) {
                            $("#prod_4_nom_error").text("El nombre no debe exceder los 20 caracteres");
                            $("#prod_4_nom_error").show();
                            validado = false;
                        }

                        if($("#prod_4_desc").val() == null || $("#prod_4_desc").val() == '') {
                            $("#prod_4_desc_error").text("Este campo es obligatorio");
                            $("#prod_4_desc_error").show();
                            validado = false;
                        }

                        if($("#prod_4_desc").val().length > 20) {
                            $("#prod_4_desc_error").text("La descripción no debe exceder los 20 caracteres");
                            $("#prod_4_desc_error").show();
                            validado = false;
                        }

                    }                   

                    return validado;

                }

                $(".input_decimal").change(function(){
                    $(this).val(parseFloat($(this).val()).toFixed(2));
                });

                function limpiarErrores() {
                    $(".input_error").text("");
                    $(".input_error").hide();
                }

                $("#pag_siguiente").click(function(){   
                    
                    if(validarPagina()) {
                        if($("#pag_tipo_radio_0").is(':checked')) {
                            ceroProd();
                        }
                        else if($("#pag_tipo_radio_2").is(':checked')) {
                            dosProd();
                        }
                        else if($("#pag_tipo_radio_4").is(':checked')) {
                            cuatroProd();
                        }
                        
                        $("#collapseProd").collapse('toggle');
                        $("#headingOne").removeClass("text-white bg-primary");
                        $("#headingTwo").addClass("text-white bg-primary"); 
                    }  
                                
                });

                $("#btn_submit").click(function(){
                    if(validarProd()) {
                        $("#form_pag").submit()
                    }

                });

                $("#prod_atras").click(function(){
                    $("#collapsePag").collapse('toggle');
                    $("#headingTwo").removeClass("text-white bg-primary");
                    $("#headingOne").addClass("text-white bg-primary");
                });             
                

            }); 
        </script>
        <!-- <script src="scripts/paginas.js"></script> -->
    </body>
</html>