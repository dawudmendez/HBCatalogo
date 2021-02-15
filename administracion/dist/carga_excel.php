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
                                    Seleccione el archivo correspondiente y presione <strong>siguiente</strong> para validar los datos.</p>   
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

                                    <table id="table_validacion" class="display order-column">
                                        <thead>
                                            <tr>
                                                <th>Código de producto</th>
                                                <th>Precio</th>
                                                <th>Estado</th>
                                                <th>Detalle</th>
                                                <th>Fecha de inicio</th>
                                                <th>Fecha de estado</th>
                                                <th>Número de página</th>
                                                <th>Número de producto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    </br>
                                    <form id="form_modificar_excel" method="POST" enctype="multipart/form-data">      
                                        <input type='hidden' name='modificar' value='modificar'>                               
                                        <a href="#" class="btn btn-success" id="btn_modificar">Guardar</a>
                                    </form>                                    
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
        <!-- Modal Confirmación Carga Inicial -->
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

        <!-- Modal Carga Final -->
        <div class="modal fade" id="modificar_excel_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" id="vaciar_carrito_modal_body">
                    Los precios de los productos validados serán modificados. </br>
                    ¿Desea continuar?
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="confirmar_modificacion_btn">Confirmar Modificación</button>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal Loading -->
        <div class="modal fade" id="procesando_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Procesando</h5>
                </div>
                <div class="modal-body" id="vaciar_carrito_modal_body">
                    <div class="text-center">
                    Aguarde por favor.<br><br>
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                <br>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal Finalización -->
        <div class="modal fade" id="finalizacion_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Carga Finalizada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body" id="vaciar_carrito_modal_body">
                    La carga finalizó correctamente.
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-success" id="finalizacion_modificacion_btn">Salir</button>
                </div>
            </div>
            </div>
        </div>

        
        <?php require_once("scripts.php"); ?>
        <script type="text/javascript" src="js/DataTables/datatables.min.js"></script>
        
        
        <script>
            $(document).ready(function(){
                
                $('#btn_cargar').click(function(){                    
                    $('#form_import_excel').submit();
                });
                
                $('#form_import_excel').on('submit', function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: "carga_controlador.php",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('#procesando_modal').modal('show');
                        },
                        success: function(data) {
                            $('#procesando_modal').modal('hide');
                            $('#form_import_excel')[0].reset();
                            
                            var data_parseada = JSON.parse(data);
                            $('#table_validacion').DataTable({
                                data: data_parseada,
                                columns: [
                                    { data: 'prod_cod' },
                                    { data: 'precio' },
                                    { data: 'estado' },
                                    { data: 'detalle' },
                                    { data: 'fecha_inicio' },
                                    { data: 'fecha_estado' },
                                    { data: 'pag_orden' },
                                    { data: 'prod_num' }
                                ],
                                language: {
                                    "decimal": "",
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Entradas",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscar:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                }
                            });

                            $("#collapseProd").collapse('toggle');
                            $("#headingOne").removeClass("text-white bg-primary");
                            $("#headingTwo").addClass("text-white bg-primary"); 
                        },
                        error: function(data) {
                            $('#procesando_modal').modal('hide');
                            $('#form_import_excel')[0].reset();
                        }
                    });
                });

                $('#btn_modificar').click(function(){                    
                    $('#form_modificar_excel').submit();
                });
                
                $('#form_modificar_excel').on('submit', function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: "carga_controlador.php",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function() {
                            $('#procesando_modal').modal('show');
                        },
                        success: function(data) {
                            $('#procesando_modal').modal('hide');
                            $('#finalizacion_modal').modal('show');                            
                        },
                        error: function(data) {
                            $('#procesando_modal').modal('hide');
                        }
                    });
                });

                $('#finalizacion_modificacion_btn').click(function(){                    
                    document.location.href="../";
                });
                

            });       
        </script>
    </body>
</html>
