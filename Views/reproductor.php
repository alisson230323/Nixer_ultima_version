<?php
// Verificar si se proporcionó un ID de película válido
if (isset($_GET['id'])) {
    $pelicula_id = $_GET['id'];

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nixer";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener la información de la película
    $sql = "SELECT * FROM peliculas WHERE id_pelicula = $pelicula_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $imagen = $row['imagen'];
        $sinopsis = $row['sinopsis'];
        $url_trailer = $row['url_trailer'];
        $url_video = $row['url'];

        // Cerrar la conexión a la base de datos
        $conn->close();
    } else {
        echo "<p>No se encontró la película.</p>";
        exit();
    }
} else {
    echo "<p>No se proporcionó un ID de película válido.</p>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reproductos.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="<?php echo $url_video; ?>"></script>
    <title>Reproductor</title>
</head>
<body style="background: linear-gradient(rgba(5,7,12,0.75),rgba(5,7,12,0.75)), url(<?php echo $imagen; ?>); 
background-repeat: no-repeat; 
background-size: cover; 
height: 100vh; 
width: auto;">

    <header class="bar-lat">
        <nav>
        <a href="contenido.php">  <i class='bx bx-arrow-back bx-lg  regre' ></i><li >regresar</li></a> 
        <a href=""> <i class='bx bx-user-circle bx-lg' ></i><li >Perfil</li></a>
        <a href="soporteusuario.html"> <i class='bx bx-cog bx-lg  engrane' ></i><li >Soporte</li></a>
        </nav>
        <img src="img/logo 1.png"  class="block" alt=""> 
    </header>
<div class="capa">
</div>

<video controls>
    <source src="videos de muestra/in time.mp4" type="video/mp4">
</video>


<img src="<?php echo $imagen; ?>" class="re-im" alt="">
<h2 style="color: white; position:absolute; left:20%; top:53%;" ><?php echo $nombre; ?></h2>
<h3 style="color: white; position:relative; top:30px; font-size: 20px;"><?php echo $sinopsis; ?></h3>
<a href="<?php echo $url_trailer; ?>" style="position: relative; top:70px;"><button  value="Ver trailer" class="ver-trailer">Ver trailer</button></a>


<a href=""><button value="crear sala" class="crear">Crear sala</button></a>

<script>
    // Función para cargar el reproductor de video de YouTube
    function onYouTubeIframeAPIReady() {
      // Crea un nuevo reproductor de video
      var player = new YT.Player('player', {
        height: '360',
        width: '640',
        videoId: 'VIDEO_ID', // Reemplaza VIDEO_ID con el ID del video de YouTube que deseas reproducir
        playerVars: {
          // Opcional: Puedes agregar parámetros adicionales, como autoplay, controles, etc.
        },
        events: {
          // Opcional: Puedes definir eventos, como onReady, onStateChange, etc.
        }
      });
    }
  </script>

</body>
</html>
