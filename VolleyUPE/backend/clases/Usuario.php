<?php

class Usuario
{
    private $correo;
    private $password;
    private $fechaNacimiento;
    private $perfil;
    private $conexion;
    
    public function __construct($correo, $password,$fechaNacimiento,$perfil)
    {
        $this->perfil = $perfil;
        $this->correo = $correo;
        $this->password = $password;
        $this->fechaNacimiento = $fechaNacimiento;
        // nombreservidor, nombreUsuario, contraseña, nombreDeLaBBDD.
        $this->conexion = new mysqli("localhost","root","","bbdd_voleyup");

        if($this->conexion->connect_error)
        {
            die("error en la conexion de base de datos ".$this->conexion->connect_error);
        }

    }
    public function registrar()
    {
        // Validar que el correo no esté en uso
        $correoExistente = $this->verificarCorreoExistente($this->correo); //correo existente guarda el valor retornado por el metodo
        if ($correoExistente) { //
            return "El correo ya está en uso."; //
        }

        $sql = "INSERT INTO usuario(correo, password, fecha_nacimiento, id_perfil) VALUES('$this->correo', '$this->password', '$this->fechaNacimiento', '$this->perfil')";

        if ($this->conexion->query($sql)) {
            return "Se registro nuevo usuario"; // Se ha registrado con éxito
        } else {
            return "Error al registrar, el correo ingresado ya existe"; // Hubo un error al registrar
        }
    }

    private function verificarCorreoExistente($correo)
    {
        $sql = "SELECT COUNT(*) as total FROM usuario WHERE correo = '$correo'"; //consulta para encontrar que no haya correos iguales
        // ejecuto la consulta
        $resultado = $this->conexion->query($sql);
    
        // primero compruebo si es que devolvió valores mi consulta
        if ($resultado->num_rows > 0) {
            // la fila del resultado de la consulta lo tomo como un array asociativo
            $fila = $resultado->fetch_assoc();
    
            //si el campo "total" en mi fila es mayor a 0, entonces significa que el correo que se ingresó ya existe
            return $fila['total'] > 0;
        }

        //si no hay correos iguales, entonces retorno falso :D
        return false;
    }



    public function consultar($correo, $password)
    {
        $sql = "SELECT * FROM usuario WHERE correo = '$correo' AND password = '$password'";
        $resultado = $this->conexion->query($sql);              //Consulta SELECT para verificar los valores existan en la BBDD
    
        if ($resultado->num_rows > 0) {                      // Si la condición es verdadera, significa que se encontraron coincidencias en la base de datos
            $usuario = $resultado->fetch_assoc();       // Recuperar la primera fila de resultados como un arreglo asociativo
            return $usuario;                        // devuelvo la información del usuario encontrado
        } else {                                // condición es falsa, no se encontraron coincidencias en la base de datos
            return null;// devuelvo 'null' para hacer saber que no se encontraron resultados
        }
    }
    

    public function validarRolUsuario() {
        // Verifica si el usuario ha iniciado sesión
        if (isset($_SESSION['usuario'])) {
            // Obtiene el correo del usuario desde la sesión
            $correo = $_SESSION['usuario'];
    
            // Realiza una consulta para obtener el ID_PERFIL del usuario
            $consulta = "SELECT ID_PERFIL FROM USUARIO WHERE CORREO = '$correo'";
            $resultado = $this->conexion->query($consulta);
    
            // Valida si se encontraron resultados, al igual que en la función consultar
            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
                $idPerfil = $fila['ID_PERFIL'];
    
                // Definir roles en base a los ID_PERFIL
                if ($idPerfil == 1) {
                    // El usuario es un administrador
                    $rolPerfil = "usuario";
                } else if ($idPerfil == 2) {
                    // El usuario es un administrador de contenido
                    $rolPerfil = "Admincontenido";
                } else if($idPerfil == 3){
                    // 
                    $rolPerfil = 'administrador';
                }
                // Cierra la conexión a la base de datos
                return $rolPerfil;
            } else {
                // No se encontró el usuario en la base de datos
                return 'Usuario_no_encontrado';
            }
        } else {
            // No se ha iniciado sesión
            return 'Usuario_no_autenticado';
        }
    }


        ////////////
        /////////////
    
    
        public function actualizarNoticia($idNoticia, $titulo, $descripcion)
        {
            try {
                $query = "UPDATE noticia SET titulo = ?, descripcion = ? WHERE id = ?"; //utilizo los "?" porque voy a trabajar con consultas preparadas (mejora la seguridad)
                $stmt = $this->conexion->prepare($query);   
                $stmt->bind_param("ssi", $titulo, $descripcion, $idNoticia); // "ssi" indica que son dos string y un entero
                                            //enlazo los valores a la consulta stmt, indicando que son 2 string(titulo y descripcion) y 1 entero (id)
                if ($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        ///////////
        public function eliminarPorCorreo($correoUsuario) {
            $sql = "DELETE FROM usuario WHERE correo = '$correoUsuario'";
            return $this->conexion->query($sql);
        }



}


?>