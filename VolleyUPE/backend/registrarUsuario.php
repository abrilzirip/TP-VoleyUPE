
<?php
require_once ('clases/Usuario.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $correo = $_POST["email"];
    $password = $_POST["passwordRegistro"];
    $fecha_edad = $_POST["fecha_edad"];
    $perfil = 3; //Le asigno el id 3 a los usuarios registrados para que tomen el rol de usuario (no admin)
    
    $usuario = new Usuario($correo, $password,$fecha_edad, $perfil); //Instancia de la clase usuario

   $resultado = $usuario->registrar();//Guardo el valor devuelto del metodo registrar en la variable resultado
   if($resultado == true)
   {
    header('Location: ../frontend/index.html');
    exit();
   }
}
?>


