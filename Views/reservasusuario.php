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
    <link rel="stylesheet" href="css/reservasusuario.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Reservas</title>
</head>
<body>
    
    <header class="bar-lat">
        <nav>
        <a href="  /Views/pre-dashboard.php">  <i class='bx bx-arrow-back bx-lg' ></i><li >regresar</li></a> 
        <a href=""> <i class='bx bx-user-circle bx-lg' ></i><li >Perfil</li></a>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <a href=""> <i class='bx bx-cog' ></i><li class="">Soporte</li></a>
        </nav>
        <img class="logo" src="img/logo 1.png" alt=""> 
    </header>
    <div class="contenedor">
      <div class="texto">
        <p>PELICULAS EN CARTELERAS</p>
      </div>
      <div class="lista"> 
        <label for="lista1">CAMBIAR TU UBICACION:</label>
        <select id="lista1">
          <option value="opcion1">Opcion 1</option>
          <option value="opcion2">Opción 2</option>
          <option value="opcion3">Opción 3</option>
          <option value="opcion4">Opción 4</option>
        </select>
      </div>
      <div class="lista">
        <label for="lista2">SELECCIONAR CINE:</label>
        <select id="lista2">
          <option value="opcion1">Opcion 1</option>
          <option value="opcion2">Opción 2</option>
          <option value="opcion3">Opción 3</option>
          <option value="opcion4">Opción 4</option>
        </select>
      </div>
    </div>
    
    <section class="catalogo">
  <?php
  // Realizar la conexión a la base de datos y obtener los datos de las películas
  $host = "localhost";
  $user = "root";
  $password = "";
  $bd = "nixer";

  $conn = mysqli_connect($host, $user, $password, $bd);

  // Consulta para obtener los datos de las películas
  $sql = "SELECT * FROM cine";
  $result = mysqli_query($conn, $sql);

  // Recorrer los resultados y mostrar las películas
  while ($row = mysqli_fetch_assoc($result)) {
    $idPelicula = $row['id_cine_peli'];
    $titulo = $row['titulo'];
    $descripcion = $row['descripcion'];
    $imagen = $row['imagen'];

    echo '<a class="pelicula" href="Reservas.php?id=' . $idPelicula . '">';
    echo '<img src="img/' . $imagen . '" alt="' . $titulo . '">';
    echo '<div class="informacion">';
    echo '<h3>' . $titulo . '</h3>';
    echo '<p>Descripción: ' . $descripcion . '</p>';
    echo '</div>';
    echo '</a>';
  }

  // Cerrar la conexión a la base de datos
  mysqli_close($conn);
  ?>
</section>





</body>
</html>
