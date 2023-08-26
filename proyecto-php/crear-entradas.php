<?php require_once 'includes/redireccion.php'; 
 require_once 'includes/cabecera.php';    
 require_once 'includes/lateral.php'; ?>


<!-- Caja principal de crear categoria -->
<div id="principal">
    <h1>Crear entrada</h1>
    <p>Añade una nueva entrada al blog para compartir con todos los usuarios.</p>
    <br/>
    <form action="guardar-entrada.php" method="POST">
        <label for="titulo">Nombre de la entrada</label>
        <input type="text" name="titulo" />
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'titulo') : ''; ?>
        <label for="descripcion">Contenido de la entrada</label>
        <textarea name="descripcion"></textarea>
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'descripcion') : ''; ?>
        <label for="categoria">Categoría</label>
        <select name="categoria">
            <?php 
            $categorias = conseguirCategorias($db);
            if(!empty($categorias)):
                while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
                    <option value="<?=$categoria['id']?>"><?=$categoria['nombre']?></option>
            <?php
                endwhile;
            endif;
            ?>
        </select>
        
        <input type="submit" value="Guardar" />
    </form>
    <?php borrarErrores() ?>
</div>


 <?php require_once 'includes/footer.php'; ?>

