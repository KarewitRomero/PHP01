<?php

if(isset($_POST)){
    //Cargar conexión a la base de datos para poder guardar
    require_once 'includes/conexion.php';
    
    //Iniciar session en el storage para poder crear la la sesion de errores
   if(!isset($_SESSION)){
        session_start();
   }
    
    //Guardar los valores del formulario
    if(isset($_POST['nombre'])){
        $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    } else {
        $nombre =  false;
    }
    
    $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;
    //Se ocupa mysqli_real_escape_string para aumentar la seguridad en el formulario, y que al momento de
    //ingresar otros caracteres los interprete como un string y no como parte de la consulta sql
    
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
    //Validar apellidos
    if(!empty($apellido) && !is_numeric($nombre) && !preg_match("/[0-9]/", $apellido)) {
        $apellido_validado = true;
    } else {
        $apellido_validado = false;
        $errores['apellido'] = "El apellido no es válido";
    }
    //Validar email
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores['email'] = "El email no es válido";
    }
    //Validar la contraseña
    if(!empty($email)) {
        $password_validado = true;
    } else {
        $password_validado = false;
        $errores['password'] = "El password no es válido";
    }
    $guardar_usuario = false;
    //Contar errores
    if(count($errores) == 0){
        $guardar_usuario = true;
        
        //Antes de guardar los datos se tiene que cifrar la contraseña
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
        //El cost es las cantidad de veces que se cifra la contraseña
        /*Cuando queramos comparar la contraseña cuando el usuario intenta logearse con la que se
        guardo lo hacemos de la siguiente manera*/
        //Verificar que las contraseñas sean iguales
        //password_verify($password, $password_segura);
        
        //Insertar los datos a la base de datos de la tabla usuarios
        $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellido', '$email', '$password_segura', CURDATE());";
        
        $guardar = mysqli_query($db, $sql);
        
        if($guardar) {
            $_SESSION['completado'] = "El registro se realizó correctamente";
        } else {
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
        }
        
        
    } else {
        $_SESSION['errores'] = $errores;
    }
    
}

//Redireccionar
header('Location: index.php');
