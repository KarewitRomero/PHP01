<?php require_once 'includes/footer.php'; ?>
 <?php require_once 'includes/cabecera.php'; ?>   
 <?php require_once 'includes/lateral.php'; ?>

<?php
if(isset($_POST)){
    //Cargar conexión a la base de datos para poder guardar
    require_once 'includes/conexion.php';
    
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    
    //Array de errores
    $errores = array();
    
    //Validar datos antes de guardarlos en la bd
    //Validar nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es válido";
    }
    
    //Guardar los datos en caso de que no lleguen errores
    if(count($errores) == 0){
        $sql = "INSERT INTO categorias VALUES(null, '$nombre');";
        $guardar = mysqli_query($db, $sql);
    }
  
}

//Redirección
    header("Location: index.php");
?>


<?php require_once 'includes/footer.php'; ?>
