<?php
require_once 'includes/conexion.php';
require_once 'includes/helpers.php';
?>

<?php 

$entrada_actual = conseguirEntrada($db, $_GET['id']);
//var_dump($categoria_actual);
//var_dump($id);
//die();
if(empty($entrada_actual)){
    header("Location: index.php");
}
?> 

<?php require_once 'includes/cabecera.php'; 
              require_once 'includes/lateral.php'; ?>

<!-- Principal -->
<div id="principal">
    
    <h1><?=$entrada_actual['titulo']?></h1>
    <a href="categoria.php?id=<?=$entrada_actual['categoria_id']?>">
        <h2><?=$entrada_actual['categoria']?></h2>
    </a>
    <h4><?=$entrada_actual['fecha']?> || <?=$entrada_actual['autor']?></h4>
    <p><?=$entrada_actual['descripcion']?></p>

    <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']): ?>
            <br/>
            <a href="editar-entrada.php?id=<?=$entrada_actual['id']?>" class="boton">Editar entrada</a>
            <a href="borrar-entrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-rojo">Eliminar entrada</a>
    <?php endif; ?>
</div>
