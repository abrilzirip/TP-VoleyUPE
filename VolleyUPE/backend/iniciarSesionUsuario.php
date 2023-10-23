<?php
require_once('clases/Usuario.php');
session_start(); // Inicia la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $password = $_POST["contraseña"];

    // consulta para verificar si el usuario y la contraseña coinciden
    $usuario = new Usuario("", "", "", "");
    $resultado = $usuario->consultar($correo, $password); //Obtengo los valores devueltos por el metodo consultar y lo guardo en resultado

    if ($resultado != null) {
        //crea una variable de sesión
        $_SESSION['usuario'] = $correo;

        // Redirijo al usuario a la página de inicio despues de que haya iniciado sesion
        header('Location: ../frontend/index.html');
        exit();
    } else {
        // Redirijo al usuario a la página de inicio si no pudo iniciar sesion
        header('Location: ../frontend/index.html');
    }
}
?>