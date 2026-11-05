<?php
include("conexion.php");

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = $_POST['password'];
$rol = $_POST['rol'];

$calle = $_POST['calle_numero'];
$colonia = $_POST['colonia'];
$ciudad = $_POST['ciudad'];
$cp = $_POST['codigo_postal'];
$telefono = $_POST['telefono'];

// 1. Insertar Usuario
$sql_usuario = "INSERT INTO usuarios (nombre, email, password, rol) VALUES ('$nombre', '$email', '$password', '$rol')";

if (mysqli_query($conexion, $sql_usuario)) {
    // 2. Obtener el ID del usuario recién insertado
    $id_usuario = mysqli_insert_id($conexion);

    // 3. Insertar la Dirección vinculando el id_usuario
    $sql_direccion = "INSERT INTO direcciones (id_usuario, calle_numero, colonia, ciudad, codigo_postal, telefono) 
                      VALUES ('$id_usuario', '$calle', '$colonia', '$ciudad', '$cp', '$telefono')";
    
    if (mysqli_query($conexion, $sql_direccion)) {
        echo "<script>alert('Usuario y dirección registrados con éxito'); window.location.href='index.html';</script>";
    } else {
        echo "Error al registrar la dirección: " . mysqli_error($conexion);
    }
} else {
    echo "Error al registrar el usuario: " . mysqli_error($conexion);
}
?>