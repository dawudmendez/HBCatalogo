<?php

if($_SESSION['usu_admin'] != 1)
{
    header('Location: acceso_denegado.php');
}

?>