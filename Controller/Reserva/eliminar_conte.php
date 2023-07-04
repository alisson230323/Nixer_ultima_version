<?php
// Obtener el ID del registro a eliminar
$id = $_POST['id'];

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nixer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Eliminar el registro de la base de datos
$sql = "DELETE FROM cine WHERE id_cine_peli = '$id'";

if ($conn->query($sql) === true) {
    echo "Registro eliminado correctamente.";
} else {
    echo "Error al eliminar el registro: '' " . $conn->error;
}

$conn->close();
?>
