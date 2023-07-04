<?php
$host = "localhost";
$user = "root";
$password = "";
$bd = "nixer";

$conn = mysqli_connect($host, $user, $password, $bd);

// Verificar si se ha enviado una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['correo'];
    $password = $_POST['contrasena'];

    // Consulta preparada para verificar las credenciales en la base de datos
    $sql = "SELECT * FROM usuario WHERE correo = ? AND clave_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $fila = $result->fetch_assoc();
        $rol = $fila['rol'];

        // Obtener el ID del usuario
        $idUsuario = $fila['id_usuario'];

        // Iniciar sesión y asignar el rol y el ID del usuario a variables de sesión
        session_start();
        $_SESSION['rol'] = $rol;
        $_SESSION['idUsuario'] = $idUsuario;

        // Redirigir según el rol del usuario
        switch ($rol) {
            case 1:
                header("Location: admin_full.php");
                break;
            case 2:
                header("Location: /Views/contadmin.php");
                break;
            case 3:
                header("Location: /Views/admin_reser.php");
                break;
            case 4:
                header("Location: /Controller/soporte/spreguntas.php");
                break;
            case 5:
                header("Location: /Views/sala.php");
                break;
            case 6:
                header("Location: /Views/pre-dashboard.php");
                break;
            case 7:
                header("Location: usuario_vip.php");
                break;
            default:
                echo 'Error en Correo o contraseña.';
                break;
        }
    } else {
        echo "<script>alert('Error en la autenticación de datos.'); window.location.href = '/../Views/login.php';</script>";
    }

    // Cerrar la consulta preparada y la conexión
    $stmt->close();
    $conn->close();
}
?>
