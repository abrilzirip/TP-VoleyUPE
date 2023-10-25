<?php
include_once ('clases/Jugador.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    
    $jugador = new Jugador("", "","","","","","");

   $resultado = $jugador->eliminarNombreYApellido($nombre, $apellido);
   if($resultado == true)
   {
    header('Location: ../frontend/controlAdmin.php');
    exit();
   }
}
// ctrol z s
?>
