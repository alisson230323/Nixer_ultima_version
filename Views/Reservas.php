<?php
// Incluir el archivo para verificar la sesión
include '../Controller/val_reg/verificar_sesion.php';
?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reserva.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Reservas </title>
</head> 
<body>
    
    <header class="bar-lat">
        <nav>
        <a href=" /Views/reservasusuario.php">  <i class='bx bx-arrow-back bx-lg  regre' ></i><li >regresar</li></a> 
        <a href=""> <i class='bx bx-user-circle bx-lg' ></i><li >Perfil</li></a>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <a href=""> <i class='bx bx-cog bx-lg  engrane' ></i><li >Soporte</li></a>
        </nav>
        <img src="img/logo 1.png"  class="block" alt=""> 
    </header>


    <form id="" action="/Controller/Reserva/guardar_reserva.php" method="post">


<div class="borde">



    <?php
    // Obtener el ID del usuario de la sesión
    $idUsuario = $_SESSION['idUsuario'];

    // Obtener el ID de la película seleccionada desde el formulario
    if (isset($_GET['id'])) {
        $idPelicula = $_GET['id'];


        // Realizar la conexión a la base de datos y obtener los datos de la película seleccionada
        $host = "localhost";
        $user = "root";
        $password = "";
        $bd = "nixer";

        $conn = mysqli_connect($host, $user, $password, $bd);
        if (!$conn) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        // Consulta para obtener los datos de la película seleccionada
        $sql = "SELECT * FROM cine WHERE id_cine_peli = '$idPelicula'";
        $result = mysqli_query($conn, $sql);

        // Verificar si se encontró la película
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Obtener los datos de la película
            $titulo = $row['titulo'];
            $imagen = $row['imagen'];
            $descripcion = $row['descripcion'];

            // Mostrar la película y su información
            echo '<div class="pelicula">';
            echo '<div class="pe">';
            echo '<img src=" img/'. $imagen . '" alt=" ">';
            echo '</div>';
            echo '<div class="despelicula">';
            echo '<h4>' . $titulo . '</h4>';
            echo '<p>' . $descripcion . '</p>';
            echo '</div>';
            echo '</div>';

            // Consultar las funciones de la película seleccionada
            $sqlFunctions = "SELECT * FROM funciones WHERE id_cine_peli = $idPelicula";
            $resultFunctions = mysqli_query($conn, $sqlFunctions);

            // Mostrar el formulario para seleccionar los asientos disponibles para cada función
            while ($function = mysqli_fetch_assoc($resultFunctions)) {
                $functionId = $function['id_funcion'];
                $functionDate = $function['fecha'];
                $functionTime = $function['hora_inicio'];
                $functionDuration = $function['duracion'];

                echo '<div class="det_fun">';
                echo "<h3>Información de la Función:</h3>";
                echo '<br>';
                echo "<h3>Fecha: $functionDate</h3>";
                echo '<br>';
                echo "<h3>Hora: $functionTime</h3>";
                echo '</div>';


                // Consultar las salas disponibles para la función
                $sqlRooms = "SELECT * FROM salas_reserva WHERE id_sala = " . $function['id_sala'];
                $resultRooms = mysqli_query($conn, $sqlRooms);
                $room = mysqli_fetch_assoc($resultRooms);
                $roomName = $room['nombre'];

                // Mostrar la sala disponible
                echo '<div class="sala">';
                echo "<p><h3>Sala disponible: $roomName</h3></p>";
                echo '</div>';

                // Consultar los asientos disponibles para la función y la sala correspondiente
                $sqlSeats = "SELECT * FROM asientos WHERE id_sala = " . $function['id_sala'] . " AND estado = 'disponible'";
                $resultSeats = mysqli_query($conn, $sqlSeats);

                // Mostrar los asientos disponibles para la función y permitir su selección
                echo '<div class="asientos">';
                echo "<label for='seat'>Selecciona tus asientos:</label>";
                echo "<select name='selectedSeats[]' id='seat' multiple>";
                while ($seat = mysqli_fetch_assoc($resultSeats)) {
                    $seatId = $seat['id_asiento'];
                    $seatRow = $seat['fila'];
                    $seatColumn = $seat['columna'];

                    echo "<option value='$seatId'>Fila: $seatRow - Asiento: $seatColumn</option>";
                }
                echo "</select>";
                echo '</div>';
            }


            echo "";
            
            

            // Cerrar la conexión a la base de datos
            mysqli_close($conn);
        } else {
            echo 'No se encontró la película seleccionada.';
        }
    } else {
        echo 'No se especificó ninguna película.';
    }
    ?>
<button class='btn-reserva' type='submit'>Reservar</button>


</div>

</form>

</body>
</html>