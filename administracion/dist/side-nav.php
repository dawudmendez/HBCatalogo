<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Catalogo</div>
                <a class="nav-link" href="configuracion_controlador.php?accion=ver">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Configuración
                </a>
                <a class="nav-link" href="usuario_controlador.php?accion=ver_todas">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                    Usuarios
                </a>
                <a class="nav-link" href="vendedor_controlador.php?accion=ver_todas">
                    <div class="sb-nav-link-icon"><i class="fas fa-hand-holding-usd"></i></div>
                    Vendedores
                </a>
                <a class="nav-link" href="pagina_controlador.php?accion=ver_todas">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Páginas
                </a>
                <a class="nav-link" href="carga_controlador.php?accion=ver">
                    <div class="sb-nav-link-icon"><i class="fas fa-file-upload"></i></div>
                    Carga de Excel
                </a>
                <!-- <div class="sb-sidenav-menu-heading">Páginas</div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePaginas" aria-expanded="false" aria-controls="collapsePaginas">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Páginas
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePaginas" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="pagina_controlador.php?accion=ver_todas">
                            Ver Todas
                        </a>
                        <a class="nav-link collapsed" href="pagina_controlador.php?accion=crear&tipo=portada">
                            Crear Portada
                        </a>
                        <a class="nav-link collapsed" href="pagina_controlador.php?accion=crear">
                            Crear Página
                        </a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTemplates" aria-expanded="false" aria-controls="collapseTemplates">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Templates
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a> -->
                <!-- <a class="nav-link" href="index.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Templates
                </a> -->
                <div class="collapse" id="collapseTemplates" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="templates.php">
                            Ver
                        </a>
                        <a class="nav-link collapsed" href="templates_crear.php">
                            Crear
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Inició sesión como:</div>
            <?php
                echo $_SESSION['usu_nombre'] . " " . $_SESSION['usu_apellido'];
            ?>
        </div>
    </nav>
</div>