<?php
//Comprobar si existe la sesion
if(!isset($_SESSION)){
    //Iniciar sesión
    session_start();
}

//Comprobar que existe la sesión de lo contrario que no tenga acceso a las demás páginas
if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}

