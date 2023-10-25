<?php
require_once('clases/Usuario.php');
session_start(); // Inicia la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que se enviaron datos y que no estén vacíos
    if (isset($_POST["correo"]) && isset($_POST["contraseña"]) && !empty($_POST["correo"]) && !empty($_POST["contraseña"])) {
        $correo = $_POST["correo"];
        $password = $_POST["contraseña"];

        // consulta para verificar si el usuario y la contraseña coinciden
        $usuario = new Usuario("", "", "", "");
        $resultado = $usuario->consultar($correo, $password);

        if ($resultado != null) {
            // Crea una variable de sesión
            $_SESSION['usuario'] = $correo;
        
            // Llama al método para validar el rol del usuario
            $tipoUsuario = $usuario->validarRolUsuario();
        
            // Redirige al usuario a la página correspondiente según su rol
            if ($tipoUsuario === 'administrador') {
                header('Location: ../frontend/index.html');
            } elseif ($tipoUsuario === 'Admincontenido') {
                header('Location: ../frontend/index.html');
            } elseif($tipoUsuario === 'usuario') {
                header('Location: ../frontend/index.html');
            }
        
            exit();
        } else {
            // Redirige al usuario a la página de inicio si no pudo iniciar sesión
            header('Location: ../frontend/index.html');
            exit();
        }
    }
}
?>



