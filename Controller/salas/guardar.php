<?php
include("conexion.php");

if (isset($_POST['save_task'])) {
    $nombreUsuario = $_POST['nombre_usuario'];
    $salaNombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $query = "REPLACE INTO sala (nombre, descripcion, lista_usuarios) VALUES ('$salaNombre', '$descripcion', '$nombreUsuario')";
    $resultado = mysqli_query($conn, $query);

    
    if (!$resultado) {
        die("Error en la consulta: " . mysqli_error($conn));
    }
    

    $_SESSION['message'] = 'La sala se ha guardado correctamente';
    $_SESSION['message_type'] = 'success';

    header("Location: /Views/sala.php");
    exit();
}
?>
