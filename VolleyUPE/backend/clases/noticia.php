<?php
class noticia
{
    private $titulo;
    private $descripcion;
    private $fecha;
    private $conexion;
    
    public function __construct($titulo, $descripcion,$fecha)
    {
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->fecha = $fecha;

        // nombreservidor, nombreUsuario, contraseña, nombreDeLaBBDD.
        $this->conexion = new mysqli("localhost","root","","bbdd_voleyup");

        if($this->conexion->connect_error)
        {
            die("error en la conexion de base de datos ".$this->conexion->connect_error);
        }

    }
}
?>