<?php
// Obtener ID del registro a eliminar
$id = $_GET['id'];

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nixer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Escapar el ID para evitar inyección de SQL
$id = $conn->real_escape_string($id);

// Eliminar el registro de la base de datos
$sql = "DELETE FROM peliculas WHERE id_pelicula='$id'";

if ($conn->query($sql) === true) {
    $mensaje = "Se eliminó el registro correctamente.";
} else {
    $mensaje = "Error al eliminar el registro: " . $conn->error;
}

$conn->close();

header("Location: /Views/contadmin.php?mensaje=" . urlencode($mensaje));
exit();
?>

