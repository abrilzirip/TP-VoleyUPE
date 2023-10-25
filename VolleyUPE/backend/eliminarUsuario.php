<?php
include_once ('clases/Usuario.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $correo = $_POST["email"];
    
    $usuario = new Usuario("", "","","");

   $resultado = $usuario->eliminarPorCorreo($correo);
   if($resultado == true)
   {
    header('Location: ../frontend/controlAdmin.html');
    exit();
   }
}
// ctrol z s
?>
