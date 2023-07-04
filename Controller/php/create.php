<?php

/*
// Obtener datos del formulario
$titulo = $_POST['titulo'];
$genero = $_POST['genero'];
$anio = $_POST['anio'];
$sinopsis = $_POST['sinopsis'];
$duracion = $_POST['duracion'];

// Obtener información del archivo de imagen
$imagenNombre = $_FILES['imagen']['name'];
$imagenTipo = $_FILES['imagen']['type'];
$imagenTamano = $_FILES['imagen']['size'];
$imagenTmp = $_FILES['imagen']['tmp_name'];

// Verificar que se haya seleccionado un archivo de imagen
if (!empty($imagenNombre)) {
    // Directorio de destino para guardar la imagen
    $directorioDestino = "C:/xampp/htdocs/NIXER/imagenes/";

    // Generar un nombre único para la imagen
    $imagenNombreUnico = uniqid() . "_" . $imagenNombre;

    // Ruta completa del archivo de imagen en el directorio de destino
    $rutaImagen = $directorioDestino . $imagenNombreUnico;

    // Mover el archivo de imagen al directorio de destino
    if (move_uploaded_file($imagenTmp, $rutaImagen)) {
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "contad";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO peliculas_series (titulo, genero, anio, sinopsis, duracion, imagen) VALUES ('$titulo', '$genero', '$anio', '$sinopsis', '$duracion', '$rutaImagen')";

        if ($conn->query($sql) === true) {
            echo "Película o serie agregada correctamente.";
        } else {
            echo "Error al agregar película o serie: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Error al subir la imagen.";
    }
} else {
    echo "Debes seleccionar una imagen.";
}*/

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nixer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Resto del código...

$titulo = mysqli_real_escape_string($conn, $_POST['nombre']);
$genero = mysqli_real_escape_string($conn, $_POST['genero']);
$anio = mysqli_real_escape_string($conn, $_POST['anio']);
$sinopsis = mysqli_real_escape_string($conn, $_POST['sinopsis']);
$duracion = mysqli_real_escape_string($conn, $_POST['duracion']);
$imagen = mysqli_real_escape_string($conn, $_POST['imagen']);
$url = mysqli_real_escape_string($conn, $_POST['url']);
$url_trailer = mysqli_real_escape_string($conn, $_POST['url_trailer']);

// Validar datos
if ($anio < 1900 || $anio > 2023) {
    $mensaje = "El año debe estar entre 1900 y 2023.";
} elseif ($duracion < 0 || $duracion > 360) {
    $mensaje = "La duración debe ser mayor o igual a 0 y menor o igual a 360.";
} else {
    // Verificar si el valor de 'genero' existe en la tabla 'categorias'
    $query = "SELECT id_categoria FROM categorias WHERE id_categoria = '$genero'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // El valor de 'genero' es válido, realizar la inserción en la tabla 'peliculas'
        $sql = "INSERT INTO peliculas (nombre, genero, anio, sinopsis, duracion, imagen, url, url_trailer) VALUES ('$titulo', '$genero', '$anio', '$sinopsis', '$duracion', '$imagen', '$url', '$url_trailer')";

        if ($conn->query($sql) === true) {
            $mensaje = "Película agregada correctamente.";
        } else {
            $mensaje = "Error al agregar película: " . $conn->error;
        }
    } else {
        $mensaje = "El valor de 'genero' no es válido. Verifica los datos ingresados.";
    }
}

header("Location: /Views/contadmin.php?mensaje=" . urlencode($mensaje));

$conn->close();
?>

