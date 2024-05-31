<?php
$servidor = "127.0.0.1:3306";
$bd = "integralsolucion";
$usuario = "root";
$pass = "root";

$con = mysqli_connect($servidor, $usuario, $pass, $bd);

if (!$con) {
    die("Error en la conexión: " . mysqli_connect_error());
}
?>
