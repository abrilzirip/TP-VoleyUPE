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
       $sql = "INSERT INTO usuario(correo,password,fecha_nacimiento, id_perfil) VALUES('$this->correo','$this->password','$this->fechaNacimiento','$this->perfil')";
       if($this->conexion->query($sql)) //Consulta que inserta los valores del usuario en la BBDD
       {
        return true;
       }
       else
       {
        return false;
       }
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
    
            // realizo una consulta para obtener el ID_PERFIL del usuario
            $consulta = "SELECT ID_PERFIL FROM USUARIO WHERE CORREO = '$correo'";
            $resultado = $this->conexion->query($consulta);

    
            // valido si se encontraron resultados al igual que como hice en la funcion consultar
            if ($resultado->num_rows > 0) {
                $fila = $resultado->fetch_assoc();
                $idPerfil = $fila['ID_PERFIL'];
    
                // validacion de si el usuario es un administrador (ID_PERFIL = 1)
                if ($idPerfil == 1) {
                    // El usuario es un administrador, puedes realizar acciones específicas para administradores aquí
                    $rolPerfil = "administrador";
                    echo 'Administrador';
                } else {
                    // El usuario no es un administrador
                    $rolPerfil = "usuario";
                    echo 'Usuario';
                }
                // Cierra la conexión a la base de datos    
                return $rolPerfil;
            } else {
                // no existe el usuario en la base de datos
                return 'usuario_no_encontrado';
            }
        } else {
            //  no se ha iniciado sesión
            return 'usuario_no_autenticado';
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



}


?>