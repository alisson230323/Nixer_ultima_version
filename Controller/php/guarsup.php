<?php
// Conectar a la base de datos (ajusta los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nixer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si la columna 'description' existe en la tabla 'problemas'
    $checkColumnQuery = "SHOW COLUMNS FROM soporte LIKE 'descripcion'";
    $result = $conn->query($checkColumnQuery);

    if ($result->num_rows == 0) {
        // La columna 'description' no existe, agregarla a la tabla 'problemas'
        $alterTableQuery = "ALTER TABLE soporte ADD COLUMN descripcion VARCHAR(255)";
        if ($conn->query($alterTableQuery) === TRUE) {
            echo "Se agregó la columna 'description' a la tabla 'problemas'.";
        } else {
            echo "Error al agregar la columna 'description': " . $conn->error;
        }
    } else {
        // Obtener los datos del formulario
        $email = $_POST['email'] ?? '';
        $description = $_POST['description'] ?? '';
        $fecha = date('Y-m-d H:i:s');

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO soporte (correo, descripcion, fecha) VALUES ('$email', '$description', '$fecha')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert(' Se le enviara un correo dentro de 24 horas habiles.'); window.location.href = ' /Views/pre-dashboard.php';</script>";
        } else {
            echo "Error al registrar el problema: " . $conn->error;
        }
    }
}

$conn->close();
?>


