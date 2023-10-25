
<?php
require_once ('clases/Usuario.php');

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $correo = $_POST["email"];
    $password = $_POST["passwordRegistro"];
    $fecha_edad = $_POST["fecha_edad"];
    $perfil = 3; //Le asigno el id 3 a los usuarios registrados para que tomen el rol de usuario (no admin)
    
    if (!empty($correo) && !empty($password) && !empty($fecha_edad)) {
        $usuario = new Usuario($correo, $password, $fecha_edad, $perfil); // Instancia de la clase Usuario

        $resultado = $usuario->registrar(); // Guardo el valor devuelto del método registrar en la variable resultado
        if ($resultado == true) {
            header('Location: ../frontend/index.html');//Redirijo a la pagina de inicio una vez que se registro el usuario
            exit();
        } else {
            // Manejar el caso en el que el registro no fue exitoso
            echo "Error al registrar el usuario.";
        }
    } else {
        // 
        echo "Todos los campos son obligatorios.";
        

    }
    } else {
        // Alguno de los campos no se envió, muestra un mensaje de error
        echo "Faltan campos en la solicitud.";

    }

?>


