
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
      <link rel="stylesheet" href="css/panel.css">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <title>Gestión de reservas</title>
  </head>
  <body>
      
      <header class="bar-lat">
          
          <img src="img/logo 1.png" alt=""> 
          <nav>
      <a href="admin_reser.php">  <i class='bx bx-calendar-event bx-md' ></i><li >Reservas</li></a><br><br><br>
      <a href="reser_carte.php"><i class='bx bx-slideshow bx-md'></i><li>Cartelera</li></a><br><br><br>
        <a href=""> <i class='bx bxs-chalkboard bx-md' ></i><li >Salas </li></a><br><br><br>
        <a href=""><i class='bx bx-dots-horizontal-rounded bx-md'></i><li>asientos</li></a><br><br><br>
        <a href=""><i class='bx bx-money-withdraw bx-md'></i><li>Pagos</li></a><br><br><br>
        <a href=""> <i class='bx bx-user-circle bx-md' ></i><li >Perfil</li></a><br><br>
        <a href=" /Controller/val_reg/logout.php"> <i class='bx bx-log-out bx-md' ></i><li >Cerrar sesion</li></a> 
      </nav>
      </header>


      <?php
// Realizar la conexión a la base de datos y obtener los datos de la película seleccionada
$host = "localhost";
$user = "root";
$password = "";
$bd = "nixer";

$conn = mysqli_connect($host, $user, $password, $bd);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consultar la información de las reservas
$sqlReservas = "SELECT r.id_reserva, u.nombre AS nombre_usuario, f.id_funcion, c.titulo AS nombre_cine, a.fila, a.columna, sr.nombre AS nombre_sala
               FROM reservas r
               INNER JOIN usuario u ON r.id_usuario = u.id_usuario
               INNER JOIN funciones f ON r.id_funcion = f.id_funcion
               INNER JOIN cine c ON f.id_cine_peli = c.id_cine_peli
               INNER JOIN asientos a ON r.id_asiento = a.id_asiento
               INNER JOIN salas_reserva sr ON a.id_sala = sr.id_sala";
$resultReservas = $conn->query($sqlReservas);

// Mostrar la información de las reservas en una tabla con clases CSS
echo "<h2  class='topp'>Información de las reservas:</h2>";
echo "<table class='reservas-table'>";
echo "<tr><th>ID Reserva</th><th>Usuario</th><th>Película</th><th>Sala</th><th>Fila</th><th>Columna</th><th>Editar</th><th>Eliminar  </th></tr>";
while ($reserva = $resultReservas->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $reserva['id_reserva'] . "</td>";
    echo "<td>" . $reserva['nombre_usuario'] . "</td>";
    echo "<td>" . $reserva['nombre_cine'] . "</td>";
    echo "<td>" . $reserva['nombre_sala'] . "</td>";
    echo "<td>" . $reserva['fila'] . "</td>";
    echo "<td>" . $reserva['columna'] . "</td>";
    echo "<td><button  class='edit-button' data-id='" . $reserva['id_reserva'] . "'><i class='bx bxs-pencil bx-xs'></i></button></td>";
    echo "<td><button class='delete-button' data-id='" . $reserva['id_reserva'] . "'><i class='bx bxs-trash bx-xs'></i></button></td>";
    echo "</tr>";
}
echo "</table>";

// Cerrar la conexión
$conn->close();
?>


  </body>
  </html>


