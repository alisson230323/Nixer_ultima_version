<?php
// Obtener datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$genero = $_POST['genero'];
$anio = $_POST['anio'];
$sinopsis = $_POST['sinopsis'];
$duracion = $_POST['duracion'];
$imagen = $_POST['imagen'];
$url = $_POST['url'];
$url_trailer = $_POST['url_trailer'];

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nixer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la consulta SQL utilizando un prepared statement
$sql = "UPDATE peliculas SET nombre=?, genero=?, anio=?, sinopsis=?, duracion=?, imagen=?, url=?, url_trailer=? WHERE id_pelicula=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisssssi", $nombre, $genero, $anio, $sinopsis, $duracion, $imagen, $url, $url_trailer, $id);

if ($stmt->execute()) {
    $mensaje = "Registro actualizado correctamente.";
} else {
    $mensaje = "Error al actualizar el registro: " . $stmt->error;
}
$stmt->close();
$conn->close();

header("Location: /Views/contadmin.php?mensaje=" . urlencode($mensaje));
exit();
?>

