<?php
$servidor = 'localhost';
$usuario = 'root';
$contrasena = '';
$basedatos = 'admin';

$conexion = new mysqli($servidor, $usuario, $contrasena, $basedatos);

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

$usu = $_POST['usuario'];
$con = $_POST['contrasena'];

$stmt = $conexion->prepare('SELECT * FROM regis WHERE usuario = ? AND contrasena = ?');
$stmt->bind_param("ss", $usu, $con);

$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    header('Location: ../index.html');
    exit;
} else {
    header('Location: iniciar.php?error=Usuario%20o%20contraseña%20incorrectos.%20Inténtalo%20de%20nuevo.');
    exit;
}

$stmt->close();
$conexion->close();
?>