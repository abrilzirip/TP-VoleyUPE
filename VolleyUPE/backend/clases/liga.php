<?php
class liga
{
    private $nombre;
    private $conexion;
    
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
        // nombreservidor, nombreUsuario, contraseña, nombreDeLaBBDD.
        $this->conexion = new mysqli("localhost","root","","bbdd_voleyup");

        if($this->conexion->connect_error)
        {
            die("error en la conexion de base de datos ".$this->conexion->connect_error);
        }

    }

}
?>