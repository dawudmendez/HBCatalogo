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
                        <h1 class="mt-4">Crear Página</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item inactive"><a href="paginas.php">Páginas</a></li>
                            <li class="breadcrumb-item active">Crear</li>
                        </ol>
                        
                        <div id="accordion">
                            <form action="admin_pagina.php" method="POST" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-header text-white bg-primary" id="headingOne">
                                    <div class="p-2"><i class="fas fa-book-open"></i> 1. Detalles de la página</div>
                                </div>

                                <div id="collapsePag" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">    
                                    <input type='hidden' name='insertar' value='insertar'>                            
                                    <div class="form-group">
                                        <label for="pag_nombre">Nombre</label>
                                        <input type="text" class="form-control" id="pag_nombre" name="pag_nombre" aria-describedby="nombre_help">
                                        <small id="nombre_help" class="form-text text-muted">El nombre de la página</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="pag_descripcion">Descripción</label>
                                        <input type="text" class="form-control" id="pag_descripcion" name="pag_descripcion" aria-describedby="descripcion_help">
                                        <small id="descripcion_help" class="form-text text-muted">Descripción de la página</small>
                                    </div>
                                    <!-- <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="pag_imagen_custom" name="pag_imagen_custom" aria-describedby="imagen_custom_help">
                                        <label class="form-check-label" for="imagen_custom_help">Usar imagen propia</label>
                                        <small id="imagen_custom_help" class="form-text text-muted">Dejar deshabilitado para que el sistema genere la imagen</small>
                                    </div> -->
                                    <div class="form-group" id="input_imagen_propia">
                                        <label for="pag_imagen">Imagen</label>
                                        <input type="file" class="form-control-file" id="pag_imagen" name="pag_imagen" aria-describedby="imagen_help"/>
                                        <small id="imagen_help" class="form-text text-muted">Imagen para la página</small>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pag_tipo_radio" id="pag_tipo_radio_0" value="0" checked>
                                        <label class="form-check-label" for="pag_tipo_radio_0">Página de portada (sin productos)</label>
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
                                        <input type="number" class="form-control" id="pag_orden" name="pag_orden" min=1 value=1 aria-describedby="orden_help">
                                        <small id="orden_help" class="form-text text-muted">Orden de la página</small>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="pag_visible" name="pag_visible">
                                        <label class="form-check-label" for="pag_visible">Visible</label>
                                    </div>  
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
                                                    <input type="text" class="form-control" id="prod_1_cod" name="prod_1_cod" aria-describedby="prod_1_cod_help">
                                                    <small id="prod_1_cod_help" class="form-text text-muted">Máximo 20 caracteres</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_1_nom">Nombre</label>
                                                    <input type="text" class="form-control" id="prod_1_nom" name="prod_1_nom" aria-describedby="prod_1_nom_help">
                                                    <small id="prod_1_nom_help" class="form-text text-muted">Máximo 20 caracteres</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_1_desc">Descripción</label>
                                                    <input type="text" class="form-control" id="prod_1_desc" name="prod_1_desc" aria-describedby="prod_1_desc_help">
                                                    <small id="prod_1_desc_help" class="form-text text-muted">Máximo 20 caracteres</small>
                                                </div> 
                                                <div class="form-group">
                                                    <label for="prod_1_pre">Precio</label>
                                                    <input type="text" class="form-control" id="prod_1_pre" name="prod_1_pre" aria-describedby="prod_1_pre_help">
                                                    <small id="prod_1_pre_help" class="form-text text-muted">Dos decimales</small>
                                                </div>                         
                                                <!-- <div class="form-group">
                                                    <label for="prod_1_ima">Imagen</label>
                                                    <input type="file" class="form-control-file" id="prod_1_ima" name="prod_1_ima" aria-describedby="prod_1_ima_help"/>
                                                    <small id="prod_1_ima_help" class="form-text text-muted">Imagen del producto</small>
                                                </div> -->
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Producto 2</h5>
                                                <div class="form-group">
                                                    <label for="prod_2_cod">Código</label>
                                                    <input type="text" class="form-control" id="prod_2_cod" name="prod_2_cod" aria-describedby="prod_2_cod_help">
                                                    <small id="prod_2_cod_help" class="form-text text-muted">Máximo 20 caracteres</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_2_nom">Nombre</label>
                                                    <input type="text" class="form-control" id="prod_2_nom" name="prod_2_nom" aria-describedby="prod_2_nom_help">
                                                    <small id="prod_2_nom_help" class="form-text text-muted">Máximo 20 caracteres</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_2_desc">Descripción</label>
                                                    <input type="text" class="form-control" id="prod_2_desc" name="prod_2_desc" aria-describedby="prod_2_desc_help">
                                                    <small id="prod_2_desc_help" class="form-text text-muted">Máximo 20 caracteres</small>
                                                </div> 
                                                <div class="form-group">
                                                    <label for="prod_2_pre">Precio</label>
                                                    <input type="text" class="form-control" id="prod_2_pre" name="prod_2_pre" aria-describedby="prod_2_pre_help">
                                                    <small id="prod_2_pre_help" class="form-text text-muted">Dos decimales</small>
                                                </div>                         
                                                <!-- <div class="form-group">
                                                    <label for="prod_2_ima">Imagen</label>
                                                    <input type="file" class="form-control-file" id="prod_2_ima" name="prod_2_ima" aria-describedby="prod_2_ima_help"/>
                                                    <small id="prod_2_ima_help" class="form-text text-muted">Imagen del producto</small>
                                                </div> -->
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
                                                    <input type="text" class="form-control" id="prod_3cod" name="prod_3_cod" aria-describedby="prod_3_cod_help">
                                                    <small id="prod_3_cod_help" class="form-text text-muted">Máximo 20 caracteres</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_3_nom">Nombre</label>
                                                    <input type="text" class="form-control" id="prod_3_nom" name="prod_3_nom" aria-describedby="prod_3_nom_help">
                                                    <small id="prod_3_nom_help" class="form-text text-muted">Máximo 20 caracteres</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_3_desc">Descripción</label>
                                                    <input type="text" class="form-control" id="prod_3_desc" name="prod_3_desc" aria-describedby="prod_3_desc_help">
                                                    <small id="prod_3_desc_help" class="form-text text-muted">Máximo 20 caracteres</small>
                                                </div> 
                                                <div class="form-group">
                                                    <label for="prod_3_pre">Precio</label>
                                                    <input type="text" class="form-control" id="prod_3_pre" name="prod_3_pre" aria-describedby="prod_3_pre_help">
                                                    <small id="prod_3_pre_help" class="form-text text-muted">Dos decimales</small>
                                                </div>                         
                                                <!-- <div class="form-group">
                                                    <label for="prod_3_ima">Imagen</label>
                                                    <input type="file" class="form-control-file" id="prod_3_ima" name="prod_3_ima" aria-describedby="prod_3_ima_help"/>
                                                    <small id="prod_3_ima_help" class="form-text text-muted">Imagen del producto</small>
                                                </div> -->
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Producto 4</h5>
                                                <div class="form-group">
                                                    <label for="prod_4_cod">Código</label>
                                                    <input type="text" class="form-control" id="prod_4_cod" name="prod_4_cod" aria-describedby="prod_4_cod_help">
                                                    <small id="prod_4_cod_help" class="form-text text-muted">Máximo 20 caracteres</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_4_nom">Nombre</label>
                                                    <input type="text" class="form-control" id="prod_4_nom" name="prod_4_nom" aria-describedby="prod_4_nom_help">
                                                    <small id="prod_4_nom_help" class="form-text text-muted">Máximo 20 caracteres</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prod_4_desc">Descripción</label>
                                                    <input type="text" class="form-control" id="prod_4_desc" name="prod_4_desc" aria-describedby="prod_4_desc_help">
                                                    <small id="prod_4_desc_help" class="form-text text-muted">Máximo 20 caracteres</small>
                                                </div> 
                                                <div class="form-group">
                                                    <label for="prod_4_pre">Precio</label>
                                                    <input type="text" class="form-control" id="prod_4_pre" name="prod_4_pre" aria-describedby="prod_4_pre_help">
                                                    <small id="prod_4_pre_help" class="form-text text-muted">Dos decimales</small>
                                                </div>                         
                                                <!-- <div class="form-group">
                                                    <label for="prod_4_ima">Imagen</label>
                                                    <input type="file" class="form-control-file" id="prod_4_ima" name="prod_4_ima" aria-describedby="prod_4_ima_help"/>
                                                    <small id="prod_4_ima_help" class="form-text text-muted">Imagen del producto</small>
                                                </div> -->
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    </br>
                                     
                                    <button type="submit" class="btn btn-success">Crear</button> <a href="#" class="btn btn-light" id="prod_atras">Atrás</a>  
                                </div>
                                </div>
                            </div>
                            <!-- <div class="card">
                                <div class="card-header" id="headingThree">
                                    <div class="p-2"><i class="fas fa-clipboard-check"></i> 3. Verificación y creación</div>
                                </div>
                                <div id="collapseVerif" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    <canvas id='textCanvas' height=1437 width=1286></canvas>
                                    <img id='image'>
                                    <button type="submit" class="btn btn-primary">Crear Página</button> <a href="#" class="btn btn-light" id="verif_atras">Atrás</a> </br>
                                </div>
                                </div>
                            </div> -->
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

                //$("#input_imagen_propia").hide();

                //$('.collapse').collapse()
                // $('#myCollapsible').collapse({
                //     toggle: false
                // })
                
                // $("#pag_imagen_custom").click(function(){
                //     if($("#pag_imagen_custom").is(':checked')) {  
                //         $("#input_imagen_propia").show();
                //     } else {  
                //         $("#input_imagen_propia").hide();
                //     }
                // });

                $("#pag_tipo_radio_0").click(function(){
                    //$("#pag_tipo_radio_1").prop("checked", true);
                    $("#prod_2_row").hide();
                    $("#prod_4_row").hide();
                });

                $("#pag_tipo_radio_2").click(function(){
                    //$("#pag_tipo_radio_1").prop("checked", true);
                    $("#prod_2_row").show();
                    $("#prod_4_row").hide();
                });

                $("#pag_tipo_radio_4").click(function(){
                    //$("#pag_tipo_radio_1").prop("checked", true);
                    $("#prod_2_row").show();
                    $("#prod_4_row").show();
                });

                $("#pag_siguiente").click(function(){                    
                    $("#collapseProd").collapse('toggle');
                    $("#headingOne").removeClass("text-white bg-primary");
                    $("#headingTwo").addClass("text-white bg-primary");                 
                });

                // $("#prod_siguiente").click(function(){
                //     $("#collapseVerif").collapse('toggle');
                //     $("#headingTwo").removeClass("text-white bg-primary");
                //     $("#headingThree").addClass("text-white bg-primary");
                // });

                $("#prod_atras").click(function(){
                    $("#collapsePag").collapse('toggle');
                    $("#headingTwo").removeClass("text-white bg-primary");
                    $("#headingOne").addClass("text-white bg-primary");
                });

                // $("#verif_atras").click(function(){
                //     // $("#collapseProd").hide();
                //     // $("#collapsePag").show();

                //     if($("#pag_tipo_radio_1").prop("checked", true)) {
                //         $("#collapsePag").collapse('toggle');
                //         $("#headingThree").removeClass("text-white bg-primary");
                //         $("#headingOne").addClass("text-white bg-primary");
                //     }
                //     else {
                //         $("#collapseProd").collapse('toggle');
                //         $("#headingThree").removeClass("text-white bg-primary");
                //         $("#headingTwo").addClass("text-white bg-primary");
                //     }                    
                // });

                // function GenerarImagen() {
                //     var tCtx = document.getElementById('textCanvas').getContext('2d'),
                //     imageElem = document.getElementById('image');

                //     document.getElementById('text').addEventListener('keyup', function (){
                //         tCtx.canvas.width = tCtx.measureText(this.value).width;
                //         tCtx.fillText(this.value, 0, 10);
                //         imageElem.src = tCtx.canvas.toDataURL();
                //         console.log(imageElem.src);
                //     }, false);
                // }


            });       
        </script>
    </body>
</html>