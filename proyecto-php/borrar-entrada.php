<?php
require_once 'includes/conexion.php';

if(isset($_SESSION['usuario']) && isset($_GET['id'])){
    $usuario_id = $_SESSION['usuario']['id'];
    $entrada_id = $_GET['id'];
    $borrar = $sql = "DELETE  FROM entradas WHERE usuario_id = $usuario_id AND id = $entrada_id";
//    mysqli_error($borar);
//    die();
    mysqli_query($db, $sql);
}

header("Location: index.php");

?>