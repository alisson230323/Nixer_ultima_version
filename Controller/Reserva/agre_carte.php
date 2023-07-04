<?php
// Obtener datos del formulario
$titulo = $_POST['titulo'];
$duracion = $_POST['duracion'];
$genero = $_POST['genero'];
$clasificacion = $_POST['clasificacion'];
$descripcion = $_POST['descripcion'];
$imagen = $_FILES['imagen']['name']; // Nombre del archivo de imagen enviado desde el formulario

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nixer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la ruta de la imagen
$targetDirectory = "images/"; // Carpeta donde se almacenarán las imágenes

// Crear la carpeta images si no existe
if (!is_dir($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

$targetFile = $targetDirectory . basename($_FILES["imagen"]["name"]); // Ruta completa del archivo de imagen
$imageUrl = '/' . $targetFile; // Ruta relativa de la imagen para guardar en la base de datos

// Mover el archivo a la carpeta de destino
if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO cine (titulo, duracion, descripcion, genero, clasificacion, imagen) VALUES ('$titulo', '$duracion', '$descripcion', '$genero', '$clasificacion', '$imageUrl')";

    if ($conn->query($sql) === true) {
        $mensaje = "Película o serie agregada correctamente.";
    } else {
        $mensaje = "Error al agregar película o serie: " . $conn->error;
    }
} else {
    $mensaje = "Error al cargar la imagen.";
}

echo "<script>alert('" . $mensaje . "'); window.location.href = '/Views/reser_carte.php';</script>";

exit();

$conn->close();
?>

window.location.href = '/Views/reser_carte.php';