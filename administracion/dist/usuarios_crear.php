<?php require_once("session.php"); ?>
<?php require_once("acceso_admin.php"); ?>
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
                        <h1 class="mt-4">Crear Usuario</h1>
                        <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item inactive"><a href="usuario_controlador.php?accion=ver_todas">Usuarios</a></li>
                            <li class="breadcrumb-item active">Crear</li>
                        </ol>
                        
                        <div id="accordion">
                            <form id="form_usu" action="usuario_controlador.php" method="POST" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-header text-white bg-primary" id="headingOne">
                                    <div class="p-2"><i class="fas fa-user-alt"></i> Datos del usuario</div>
                                </div>

                                <div id="collapsePag" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">    
                                    <input type='hidden' name='insertar' value='insertar'>          
                                    <div class="form-group">
                                        <label for="usuario">Usuario</label>
                                        <input type="text" class="form-control" id="usuario" name="usuario" maxlength="50" autocomplete="off">
                                        <small id="usuario_error" class="form-text text-danger input_error"></small>
                                        <small id="usuario_success" class="form-text text-success input_error"></small>
                                    </div>   
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" maxlength="50" autocomplete="off">
                                        <small id="password_error" class="form-text text-danger input_error"></small>
                                    </div>   
                                    <div class="form-group">
                                        <label for="password2">Reingrese Password</label>
                                        <input type="password" class="form-control" id="password2" name="password2" maxlength="50" aria-describedby="email_help" value="" placeholder="Dejar en blanco para no modificar">
                                        <small id="password2_error" class="form-text text-danger input_error"></small>
                                    </div>        
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" maxlength="50" aria-describedby="nombre_error"  placeholder="Su nombre"required pattern="[A-Za-z]+" >
                                        <small id="nombre_error" class="form-text text-danger input_error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido">Apellido</label>
                                        <input type="text" class="form-control" id="apellido" name="apellido" maxlength="50" aria-describedby="apellido_error" placeholder="Su apellido" required pattern="[A-Za-z]+">
                                        <small id="apellido_error" class="form-text text-danger input_error"></small>
                                    </div>                                    
                                    
                                    <!-- <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="pag_visible" name="pag_visible">
                                        <label class="form-check-label" for="pag_visible">Visible</label>
                                    </div>   -->
                                    <!-- <button type="submit" class="btn btn-success">Crear</button> -->
                                    <a href="#" id="btn_submit" class="btn btn-success">Crear</a>
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

                var usuarioDisponible;

                $("#usuario").blur(function(){

                    let usuario = $(this).val();

                    if(usuario == null || usuario == "") {
                        $("#usuario_success").text("");
                        $("#usuario_error").text("");
                        return null;
                    }

                    $.ajax({
                        url: "usuario_controlador.php",
                        method: "POST",
                        data: {
                            'usuario': usuario,
                            'validar': 'validar'
                        },
                        datatype: "text",
                        success: function(retorno) {
                            if(retorno == "true") {
                                $("#usuario_success").text("El usuario está disponible");
                                $("#usuario_error").text("");
                                usuarioDisponible = true;
                            }
                            else {
                                $("#usuario_error").text("El usuario no está disponible");
                                $("#usuario_success").text("");
                                usuarioDisponible = false;
                            }                            
                        },
                        error: function(retorno) {
                            $("#usuario_error").text("El usuario no está disponible");
                            $("#usuario_success").text("");
                            usuarioDisponible = false;
                        }
                    });

                });  
                
                function validarUsuario() {

                    limpiarErrores()

                    let validado = true; 

                    if(!usuarioDisponible) {
                        $("#usuario_error").text("El usuario no está disponible");
                        $("#usuario_error").show();
                        validado = false;
                    }

                    if($("#usuario").val() == null || $("#usuario").val() == '') {
                        $("#usuario_error").text("Este campo es obligatorio");
                        $("#usuario_error").show();
                        validado = false;
                    }

                    if($("#usuario").val().length > 50) {
                        $("#usuario_error").text("El nombre de usuario no debe exceder los 50 caracteres");
                        $("#usuario_error").show();
                        validado = false;
                    }

                    if($("#password").val() == null || $("#password").val() == '') {
                        $("#password_error").text("Este campo es obligatorio");
                        $("#password_error").show();
                        validado = false;
                    }

                    if($("#password").val().length > 50) {
                        $("#password_error").text("El password no debe exceder los 50 caracteres");
                        $("#password_error").show();
                        validado = false;
                    }

                    if($("#password").val() != $("#password2").val()) {
                        $("#password_error").text("Los passwords no coinciden");
                        $("#password_error").show();
                        $("#password2_error").text("Los passwords no coinciden");
                        $("#password2_error").show();
                        validado = false;
                    }

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
                    
                    return validado;
                }

                function limpiarErrores() {
                    $(".input_error").text("");
                    $(".input_error").hide();
                }

                $("#btn_submit").click(function(){
                    if(validarUsuario()) {
                        $("#form_usu").submit()
                    }

                });

                

            }); 
        </script>
        <!-- <script src="scripts/paginas.js"></script> -->
    </body>
</html>