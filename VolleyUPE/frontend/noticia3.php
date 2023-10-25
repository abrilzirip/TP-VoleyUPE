<?php
    require_once("../backend/clases/Usuario.php");

    session_start();

    // inicializo las variables en ''
    $correoUsuario = $passwordUsuario = $fechaNacimientoUsuario = $idPerfilUsuario = '';
    // aca me conecto a la bbdd
     $conexion = new mysqli("localhost", "root", "", "bbdd_voleyup");
    $usuario = new Usuario("","","","");
    $tipoUsuario = $usuario->validarRolUsuario(); //valido que el tipo de usuario sea administrador para mostrar en la pagina el boton para editar la noticia
    

    // Realiza una consulta para obtener los datos de la noticia desde la base de datos
    $sql = "SELECT titulo, descripcion FROM noticia WHERE id = ?"; // Reemplaza 'id' por el nombre de tu columna de identificación
    $idNoticia = 1; // reemplazo el valor por el ID de la noticia que deseo mostrar
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idNoticia); // "i" indica que es un valor entero

    if ($stmt->execute()) {
        $stmt->bind_result($titulo, $parrafo); //las variables titulo y parrafo  tienen los valores de titulo y descripcion de la noticia q obtuve de la bbdd
        $stmt->fetch();
    }
    $conexion->close(); //cierro la conexion a la bbdd

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticia 3</title>
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="stylesLink.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div id="fondo"></div>
    <!-- Incluyo la barra de navegación utilizando JavaScript -->
    <div id="navbar-container"></div>



        <div class="text-center">

        <img class="imagen img-fluid" src="../imagenes/noticias/juar2023.jpg" alt="juar2023" >
            <?php
                if (isset($_SESSION['usuario']) && $tipoUsuario === 'Admincontenido') {
                    echo '<a href="editarNoticia.php"  class="btn btn-primary">Editar Noticia</a>';
                }
            ?>
            <h3><?php echo $titulo; ?></h3> <!-- Acá solamente imprimo en la pagina los valores que obtuve de la tabla de mi BBDD (el titulo y el parrafo de la noticia que exista en la bbdd) -->
            <p class="text-white text-center" ><?php echo $parrafo; ?></p>
            <img class="imagen img-fluid" src="../imagenes/noticias/2dolugar.png" alt="2dolugar" style="width: 70%; height: 100%;">
        </div>
    <footer>
        <!-- Incluyo el footer utilizando JavaScript -->
        <div id="footer-container"></div>
    </footer>
</body>
</html>