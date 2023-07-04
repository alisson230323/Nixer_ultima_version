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

    // Eliminar un registro
    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        $sql = "DELETE FROM soporte WHERE id_soporte = $id";
        $resultado = $conn->query($sql);

        if ($resultado) {
            echo "<script>alert(' Registro elimnado.'); window.location.href = 'spreguntas.php';</script>";
        } else {
            echo "<p>Error al eliminar el registro: " . $conn->error . "</p>";
        }
    }

    ?>