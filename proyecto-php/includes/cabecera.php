<?php require_once 'conexion.php'; ?>
<?php require_once 'helpers.php'; ?>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Blog</title>
        <link rel="stylesheet" type="text/css" href="./assets/css/style.css"/>
    </head>
    <body>
        <!-- Cabecera -->
        <header id="cabecera">
            <!-- Logo -->
            <div id="logo">
                <a href="index.php">
                    <h1>Blog</h1>
                </a>
            </div>
            
            <!-- Menu -->
            <?php $categorias = conseguirCategorias($db); ?>
            <nav id="menu">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <?php if(!empty($categorias)): ?>
                        <?php while($categoria = mysqli_fetch_assoc($categorias)): ?>
                            <li><a href="categoria.php?id=<?=$categoria['id'] ?>"><?= $categoria['nombre'] ?></a></li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <li><a href="index.php">Sobre mí</a></li>
                    <li><a href="index.php">Contacto</a></li>
                    
                </ul>
            </nav>
            <div class="clearfix"></div>
        </header>
        <div id="contenedor">
