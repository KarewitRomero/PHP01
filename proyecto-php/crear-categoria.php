<?php require_once 'includes/redireccion.php'; ?>
 <?php require_once 'includes/cabecera.php'; ?>   
 <?php require_once 'includes/lateral.php'; ?>


<!-- Caja principal de crear categoria -->
<div id="principal">
    <h1>Crear categoria</h1>
    <p>Añade una nueva categoria (El nombre debe contener solamente letras)</p>
    <br/>
    <form action="guardar-categoria.php" method="POST">
        <label for="nombre">Nombre de la categoria</label>
        <input type="text" name="nombre" />
        
        <input type="submit" value="Guardar" />
    </form>
</div>


 <?php require_once 'includes/footer.php'; ?>

