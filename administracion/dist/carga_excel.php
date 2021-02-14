<?php require_once("session.php"); ?>
<?php require_once("acceso_admin.php"); ?>
<?php require_once("head.php"); ?>

<body class="sb-nav-fixed">
        <?php require_once("top-nav.php"); ?>
        <div id="layoutSidenav">
            <?php require_once("side-nav.php"); ?>            
            <div id="layoutSidenav_content">
                <main>                    
                    <div class="container-fluid">
                        <h1 class="mt-4">Carga de Excel</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Cargar Excel</li>
                        </ol>
                        
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header text-white bg-primary" id="headingOne">
                                    <div class="p-2"><i class="fas fa-book-open"></i> 1. Carga inicial</div>
                                </div>

                                <div id="collapsePag" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">    
                                    <p>Desde esta sección se podrán modificar <strong>los precios</strong> de los productos existentes en el catálogo. <br>
                                    Seleccione el archivo correspondiente y presione <strong>siguiente</strong> para validar los datos. 
                                    Tenga en cuenta que <strong>cualquier carga previa</strong>, completada o no, <strong>será eliminada</strong>.</p>     
                                    <form id="form_import_excel" method="POST" enctype="multipart/form-data">      
                                        <input type='hidden' name='crear' value='crear'>               
                                        <div class="form-group" id="div_archivo_excel">
                                            <label for="input_archivo_excel">Archivo Excel</label>
                                            <input type="file" class="form-control-file" id="input_archivo_excel" name="input_archivo_excel"
                                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                                            <small id="archivo_excel_error" class="form-text text-danger input_error"></small>
                                        </div>                                    
                                        <a href="#" class="btn btn-primary" id="btn_cargar">Siguiente</a>
                                    </form>
                                </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">  
                                    <div class="p-2"><i class="fas fa-shopping-basket"></i> 2. Validación</div>
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
                                                    <input type="text" class="form-control" id="prod_3_cod" name="prod_3_cod" maxlength="20">
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
                        </div>

                    </div>
                </main>
                <?php require_once("footer.php"); ?>
            </div>
        </div>

        <!-- Modals -->
        <div class="modal fade" id="cargar_excel_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cargar Excel y Validar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" id="vaciar_carrito_modal_body">
                    Al continuar se eliminará cualquier carga en proceso o abandonada. </br>
                    ¿Desea continuar?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="confirmar_carga_btn">Confirmar Carga</button>
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="cargar_excel_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" id="vaciar_carrito_modal_body">
                    Al continuar se modificarán los precios de los productos validados. </br>
                    ¿Desea continuar?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="confirmar_carga_btn">Confirmar Modificación</button>
                </div>
            </div>
            </div>
        </div>

        
        <?php require_once("scripts.php"); ?>
        <script>
            $(document).ready(function(){
                
                $('#form_import_excel').one('submit', function(event) {
                    event.preventDefault();
                    $ajax({
                        url: "carga_controlador.php",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('#import').attr('disabled', 'disabled');
                            $('#import').val('Importing...');
                        },
                        success: function(data) {
                            alert("Ando guacho");
                            $('#form_import_excel')[0].reset();
                        }
                    });
                });

            });       
        </script>
    </body>
</html>
