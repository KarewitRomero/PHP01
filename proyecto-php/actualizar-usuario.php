<?php

if(isset($_POST)){
    //Cargar conexión a la base de datos para poder guardar
    require_once 'includes/conexion.php';
    
    //Guardar los valores del formulario
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']): false;
    $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
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
    
    $guardar_usuario = false;
    //Contar errores
    if(count($errores) == 0){
        $usuario = $_SESSION['usuario'];
        $guardar_usuario = true;
        
        //Comprobar si el email ya existe
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email';";
        $isset_email = mysqli_query($db, $sql);
        $isset_usuario = mysqli_fetch_assoc($isset_email);
        
        if($isset_usuario['id'] == $usuario['id'] || empty($isset_usuario)){
            //Actualizar los datos a la base de datos de la tabla usuarios
            $usuario = $_SESSION['usuario'];
            $sql = "UPDATE usuarios SET ".
                    "nombre = '$nombre', ".
                    "apellidos = '$apellido' ".
                    "email = '$email".
                    "WHERE  id = ". $usuario['id'].";";

            $guardar = mysqli_query($db, $sql);

            if($guardar) {
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellido;
                $_SESSION['usuario']['email'] = $email;
                $_SESSION['completado'] = "Tus datos se han actualizado exitosamente";
            } else {
                $_SESSION['errores']['general'] = "Fallo al actualizar los datos";
            }
        } else {
            $_SESSION['errores']['general'] = "El email ya esta registrado";
        }
        
    } else {
        $_SESSION['errores'] = $errores;
    }
    
}

//Redireccionar
header('Location: mi-perfil.php');