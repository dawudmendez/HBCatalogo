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
                    <h1 class="mt-4">Acceso denegado</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Administración</li>
                    </ol>
                    <div class="row">
                        <div class="col-12">
                        <a href="index.php" class="btn btn-success">Volver</a>
                        </br>
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
