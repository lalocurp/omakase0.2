<?php
$host = "localhost";
$usuario = "root";
$password = ""; // En XAMPP por defecto la contraseña viene vacía
$bd = "omakase_escuela";

// Crear conexión con MySQLi
$conexion = mysqli_connect($host, $usuario, $password, $bd);

// Verificar si hubo error en la conexión
if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Configurar el conjunto de caracteres a UTF-8
mysqli_set_charset($conexion, "utf8mb4");
?>