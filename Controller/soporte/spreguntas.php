<?php
// Incluir el archivo para verificar la sesión
include 'C:\Users\Usuario\Desktop\NIXER\Controller\val_reg\verificar_sesion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Problemas reportados</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="supadmin.css">
</head>


<body style="padding: 0;
margin:0" >

    <header class="bar-lat">
        
        <img src="/Views/img/logo 1.png" alt=""> 
        <nav>
     <a href="">  <i class='bx bx-line-chart bx-md' ></i><li >Analisis</li></a>  <br><br><br><br><br><br>
      <a href=""><i class='bx bxs-user-account bx-md' style='color:#ffffff'></i><li>Usuarios</li></a> <br><br><br><br><br><br>
      <a href=""> <i class='bx bx-calendar-week bx-rotate-90 bx-md' ></i><li >Reservas </li></a> <br><br><br><br><br><br>
      <a href=""> <i class='bx bx-user-circle bx-md' ></i><li >Perfil</li></a> <br><br><br><br><br><br>
      <a href=" /Controller/val_reg/logout.php"> <i class='bx bx-log-out bx-md' ></i><li >Cerrar sesion</li></a>
     
    </nav>
    </header>


    <h1 class="h1">Problemas reportados por los usuarios</h1>

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
        $sql = "DELETE FROM problemas WHERE id = $id";
        $resultado = $conn->query($sql);

        if ($resultado) {
            echo "<p>Registro eliminado exitosamente.</p>";
        } else {
            echo "<p>Error al eliminar el registro: " . $conn->error . "</p>";
        }
    }

    // Obtener los problemas reportados por los usuarios
    $sql = "SELECT id_soporte, correo, descripcion FROM soporte";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar los problemas en una tabla
        echo "<table>";
        echo "<tr><th>Email</th><th>Descripción</th><th>Acciones</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['correo'] . "</td>";
            echo "<td>" . $row['descripcion'] . "</td>";
            echo "<td><button class='delete-btn' onclick='confirmDelete(" . $row['id_soporte'] . ")'>Eliminar</button></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se han reportado problemas.</p>";
    }

    $conn->close();
    ?>

    <script>
        function confirmDelete(id) {
            if (confirm("¿Estás seguro de que quieres eliminar este registro?")) {
                window.location.href = "admin.php?delete_id=" + id;
            }
        }
    </script>
</body>
</html>
