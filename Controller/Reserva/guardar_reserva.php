<?php

// Inicio de sesión
session_start();

// Obtener los parámetros del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del usuario de la sesión
    $idUsuario = $_SESSION['idUsuario'];

    // Obtener el ID de la película seleccionada desde el formulario
    if (isset($_GET['id'])) {
        $idPelicula = $_GET['id'];

        // Obtener los asientos seleccionados
        $seats = $_POST['selectedSeats'];

        // Realizar la conexión a la base de datos
        $host = "localhost";
        $user = "root";
        $password = "";
        $bd = "nixer";

        $conn = mysqli_connect($host, $user, $password, $bd);
        if (!$conn) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        // Verificar la disponibilidad de los asientos
        $availableSeats = true;

        foreach ($seats as $seatId) {
            // Consultar el estado del asiento
            $sqlSeat = "SELECT estado FROM asientos WHERE id_asiento = '$seatId'";
            $resultSeat = mysqli_query($conn, $sqlSeat);

            if (mysqli_num_rows($resultSeat) > 0) {
                $seat = mysqli_fetch_assoc($resultSeat);
                $estado = $seat['estado'];

                if ($estado !== 'disponible') {
                    $availableSeats = false;
                    break;
                }
            } else {
                $availableSeats = false;
                break;
            }
        }

        if ($availableSeats) {
            // Obtener la función de la película seleccionada
            $sqlFunction = "SELECT id_funciones FROM funciones WHERE id_cine_peli = '$idPelicula'";
            $resultFunction = mysqli_query($conn, $sqlFunction);

            if (mysqli_num_rows($resultFunction) > 0) {
                $function = mysqli_fetch_assoc($resultFunction);
                $idFuncion = $function['id_funciones'];

                // Iniciar una transacción para realizar la reserva y actualizar los asientos
                mysqli_autocommit($conn, false);

                $error = false;

                // Guardar la reserva en la base de datos
                $fechaReserva = date("Y-m-d");

                $sqlReserva = "INSERT INTO reservas (id_usuario, id_funcion, id_asiento, fecha_reserva) VALUES ";

                foreach ($seats as $seatId) {
                    $sqlReserva .= "('$idUsuario', '$idFuncion', '$seatId', '$fechaReserva'), ";
                }

                // Eliminar la coma y el espacio extra al final de la consulta
                $sqlReserva = rtrim($sqlReserva, ", ");

                $resultReserva = mysqli_query($conn, $sqlReserva);

                if (!$resultReserva) {
                    $error = true;
                }

                // Actualizar el estado de los asientos a "reservados"
                $sqlUpdateSeats = "UPDATE asientos SET estado = 'reservado' WHERE id_asiento IN (" . implode(",", $seats) . ")";
                $resultUpdateSeats = mysqli_query($conn, $sqlUpdateSeats);

                if (!$resultUpdateSeats) {
                    $error = true;
                }

                if ($error) {
                    echo "Hubo un error al realizar la reserva o actualizar los asientos";
                    // Revertir la transacción
                    mysqli_rollback($conn);

                    // Aquí puedes agregar el manejo de errores adecuado
                } else {
                    // Confirmar la transacción
                    mysqli_commit($conn);

                    echo "Reserva realizada exitosamente";
                    // Aquí puedes redireccionar a una página de confirmación o realizar alguna otra acción
                }
            } else {
                echo "No se encontró la función de la película seleccionada";
                // Aquí puedes agregar el manejo de errores adecuado
            }
        } else {
            echo "Los asientos seleccionados ya no están disponibles";
            // Aquí puedes agregar el manejo de errores adecuado
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    } else {
        echo "No se especificó ninguna '$sqlReserva'";
        // Aquí puedes agregar el manejo de errores adecuado
    }
} else {
    echo "No se recibió ninguna solicitud POST";
    // Aquí puedes agregar el manejo de errores adecuado
}
?>
