<?php 

class ConexionBD {

    private $conexion;

    function __construct() {

        $servidor = "127.0.0.1:3306";
        $usuario = "root";
        $contraseña = "root";
        $baseDatos = "integralsolucion";

        $this->conexion = mysqli_connect($servidor, $usuario, $contraseña,$baseDatos);
    }

    public function getConexion() {
        return $this->conexion;
    }

    public function cerrarConexion() {
        $this->conexion->close();
    }

}

?>