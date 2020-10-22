<?php require_once("session.php"); ?>
<?php require_once("head.php"); ?>
<body class="sb-nav-fixed">
    <?php include_once("top-nav.php"); ?>
    <div id="layoutSidenav">
        <?php include_once("side-nav.php"); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <?php require_once("alerts.php"); ?>
                    <h1 class="mt-4"><?php echo $_SESSION["nombre_sitio"]; ?>: Catálogo Online</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Administración</li>
                    </ol>
                    <div class="row">
                        <div class="col-12">
                        <p>Bienvenido al sistema de administración del catálogo online.</p>
                        </br>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Configuración</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="configuracion_controlador.php?accion=ver">Configuración básica del catálogo</a>
                                    <div class="small text-white"><i class="fas fa-tachometer-alt"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Usuarios</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="usuario_controlador.php?accion=ver_todas">Usuarios del sistema</a>
                                    <div class="small text-white"><i class="fas fa-user-alt"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Vendedores</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="vendedor_controlador.php?accion=ver_todas">Vendedores y links</a>
                                    <div class="small text-white"><i class="fas fa-hand-holding-usd"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Páginas</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="pagina_controlador.php?accion=ver_todas">Páginas y productos</a>
                                    <div class="small text-white"><i class="fas fa-book-open"></i></div>
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
</body>
</html>
