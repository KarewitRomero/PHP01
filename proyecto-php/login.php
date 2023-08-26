<?php

//Iniciar la sesion y la conexión a la base de datos
require_once 'includes/conexion.php';

//Recoger los datos del formulario
if(isset($_POST)){
    
    //Borrar error antigua
    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }
    
    //Recoger datos del formulario
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    //Consulta para validar si existe ese usuario (email y contraseña) las credenciales
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);
    
    if($login && mysqli_num_rows($login) == 1){
        
        $usuario = mysqli_fetch_assoc($login); //Se obtiene un array asociativo(los datos del usuario)
//        var_dump($usuario);
//        die();
        //Comprobar la contraseña
        $verificacion = password_verify($password, $usuario['password']);
        
        if($verificacion) {
            
            //Utilizar una sesión para guardar los datos del usuario logeado
            $_SESSION['usuario'] = $usuario;
            
                        
        } else {
            //Si algo falla enviar una sesión con el fallo
            $_SESSION['error_login'] = "Las credenciales son incorrectas";
        }
        
    } else {
        //Mensaje de error
        $_SESSION['error_login'] = "Las credenciales son incorrectas";
    }
      
}

//Redirigir al index
header('Location: index.php');

