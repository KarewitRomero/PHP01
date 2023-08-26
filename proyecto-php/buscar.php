
<?php 
if(empty($_POST['buscar'])){
    header("Location: index.php");
}

?> 

<?php require_once 'includes/cabecera.php'; 
              require_once 'includes/lateral.php'; ?>

<!-- Principal -->
<div id="principal">
    
    <h1>Busqueda de: <?=$_POST['buscar']?></h1>
    <?php
        $entradas = conseguirEntradas($db, null, null,  $_POST['buscar']);
        if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
            while($entrada = mysqli_fetch_assoc($entradas)):
    ?>
                <article class="entrada">
                    <a href="entrada.php?id=<?=$entrada['id']?>">
                        <h2><?= $entrada['titulo'] ?></h2>
                        <span class="fecha"><?= $entrada['categoria'].' | '.$entrada['fecha'] ?></span>
                        <p><?= substr($entrada['descripcion'], 0, 150)."..." ?></p>
                        <!-- Permite delimitar la cantidad de letras que aparecen con la función de substr -->
                    </a>
                </article>
    <?php
            endwhile;
        else:
    ?>
    <div class="alerta">No hay coincidencias con tu busqueda :(</div>
    <?php
        endif;
    ?>

</div>
   
<?php require_once 'includes/footer.php'; ?>
