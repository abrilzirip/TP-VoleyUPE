<?php

class Usuario
{
    private $correo;
    private $password;
    private $fechaNacimiento;
    private $conexion;
    
    public function __construct($correo, $password,$fechaNacimiento)
    {

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
       $sql = "INSERT INTO usuario(correo,password,fecha_nacimiento) VALUES('$this->correo','$this->password','$this->fechaNacimiento')";
       if($this->conexion->query($sql))
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
        $resultado = $this->conexion->query($sql);
    
        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            return $usuario;
        } else {
            return null;
        }
    }
    

}


?>