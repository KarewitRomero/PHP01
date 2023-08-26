<?php

//Conexión
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'blog_master';
$port = 3308;
$db = mysqli_connect($server, $username, $password, $database, $port);

mysqli_query($db, "SET NAMES 'utf-8");

//Comprobar si existe la sesion
if(!isset($_SESSION)){
    //Iniciar sesión
    session_start();
}