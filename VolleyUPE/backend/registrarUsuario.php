
<?php
include_once ('clases/Usuario.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $correo = $_POST["email"];
    $password = $_POST["contraseña"];
    $fecha_edad = $_POST["fecha_edad"];
    
    $usuario = new Usuario($correo, $password,$fecha_edad);

   $resultado = $usuario->registrar();
   if($resultado == true)
   {
    header('Location: ../frontend/index.html');
    exit();
   }
}
?>