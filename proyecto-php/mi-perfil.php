<?php require_once 'includes/redireccion.php'; 
 require_once 'includes/cabecera.php';    
 require_once 'includes/lateral.php'; ?>

<!-- Caja para editar los datos -->
<div id="principal">
    <h1>Editar datos</h1>
    
    <!-- Mostrar errores -->
            <?php if(isset($_SESSION['completado'])) : ?>
            <div class="alerta alerta-exito"><?= $_SESSION['completado'] ?></div>
            <?php elseif(isset($_SESSION['errores']['general'])): ?>
            <div class="alerta alerta-error"><?= $_SESSION['errores']['general'] ?></div>
            <?php endif; ?>

            <form action="actualizar-usuario.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" value="<?= $_SESSION['usuario']['nombre']; ?>" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" value="<?= $_SESSION['usuario']['apellidos']; ?>" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>
                
                <label for="email">Email</label>
                <input type="email" name="email"  value="<?= $_SESSION['usuario']['email']; ?>" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

                <input type="submit" value="Actualizar" name="submit" />
            </form>
    <?php borrarErrores() ?>
</div>

 <?php require_once 'includes/footer.php'; ?>

