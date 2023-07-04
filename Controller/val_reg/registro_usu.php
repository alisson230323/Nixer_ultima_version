<?php

// Datos de conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$bd = "nixer";

// Conexión a la base de datos
$conexion = mysqli_connect($host, $user, $password, $bd);

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die('Error al conectar a la base de datos: ' . mysqli_connect_error());
}

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$identificacion = $_POST['identificacion'];
$rol = 6;

// Validar si los datos ya están registrados en la base de datos
$sql = "SELECT * FROM usuario WHERE identificacion = ?";
$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "s", $identificacion);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

// Verificar si se encontraron registros
if (mysqli_num_rows($resultado) > 0) {
    echo 'El correo ya está registrado. Por favor, utiliza otro correo.';
} else {
    // Preparar la consulta SQL utilizando marcadores de posición (?)
    $sql = "INSERT INTO usuario (clave_usuario, nombre, apellido, identificacion, telefono, rol, correo) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);

    // Asociar los parámetros a la consulta preparada
    mysqli_stmt_bind_param($stmt, "sssssis", $contrasena, $nombre, $apellidos, $identificacion, $telefono, $rol, $correo);

    // Ejecutar la consulta preparada
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Bienvenido a Nixer'); window.location.href = '/Views/login.php';</script>";
    } else {
        echo 'Error al registrar: ' . mysqli_stmt_error($stmt);
    }

    // Cerrar la consulta preparada
    mysqli_stmt_close($stmt);
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);

?>
