<?php
if(isset($_POST)){
    //Cargar conexión a la base de datos para poder guardar
    require_once 'includes/conexion.php';
    
    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
    $usuario = $_SESSION['usuario']['id'];
    
    //Array de errores
    $errores = array();
    
    //Validar datos antes de guardarlos en la bd
    //Validar titulo
    if(empty($titulo)) {
        $errores['titulo'] = "El titulo no es válido";
    } 
    //Validar descripción
    if(empty($descripcion)) {
        $errores['descripcion'] = "La descripción no es válida";
    } 
    //Validar categoria
    if(empty($categoria) && !is_numeric($categoria)) {
        $errores['categoria'] = "La categoria no es válida";
    }
    
    //Guardar los datos en caso de que no lleguen errores
    if(count($errores) == 0){
        if(isset($_GET['editar'])){
            $entrada_id = $_GET['editar'];
            $usuario_id = $_SESSION['usuario']['id'];
            
            $sql = "UPDATE entradas SET ".
                    "categoria_id = $categoria,".
                    "titulo = '$titulo',".
                    "descripcion = '$descripcion'"
                    . "WHERE id = $entrada_id AND usuario_id = $usuario_id;";
        } else {
            $sql = "INSERT INTO entradas VALUES(null, $usuario,$categoria,'$titulo', '$descripcion', CURDATE());";
        }
        $guardar = mysqli_query($db, $sql);
        //Redirección
        header("Location: index.php");
    } else {
        $_SESSION["errores_entradas"] = $errores;
        if(isset($_GET['editar'])){
            //Redirección
            header("Location: editar-entradas.php?id=".$_GET['editar']);
        } else {
            //Redirección
            header("Location: crear-entradas.php");
        }
    }
  
}

?>
