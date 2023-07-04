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
    <title>Contenido</title>
    <link rel="stylesheet" href="css/contenido.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="js/carrusel.js" defer></script>
    <script src="js/carrusel2.js" defer></script>
    <script src="js/carrusel3.js" defer></script>
    <script src="js/carrusel4.js" defer></script>
    <script src="js/carrusel5.js" defer></script>
    <script src="js/carrusel6.js" defer></script>
    <script src="js/carrusel7.js" defer></script>
    <script src="js/carrusel8.js" defer></script>
    <script src="js/carrusel9.js" defer></script>


</head>
<body>
    <div class="head">
        <div class="logo">
            <a href="#"><img class="logi"  src="img/logoem.png" alt=""></a>
        </div>
        <div class="menu1">
            <a  class="ini ini1"  href="pre-dashboard.php">regresar</a>
        </div>
        <div>
            <a href="#"><i class='bx bx-user-circle bx-lg perfil'></i></a>
        </div>
    </div>
    <div class="menu">
        <nav class="nav">
            <br>
            <br>
            <div class="search">
                <input type="search"
                placeholder="Buscar ">
                <i class='bx bx-search bx-sm enter'></i>
            </div>
            <br>
            <div class="peliculas">
                <br>
                <h4>Peliculas</h4>
                <ul class="categoriaspe">
                    <li class="list-peliculas"><a href="#accion">Acción</a></li>
                    <li class="list-peliculas"><a href="#romance">Romance</a></li>
                    <li class="list-peliculas"><a href="#familiar">Familiar</a></li>
                </ul>
                <ul class="categoriaspe">
                    <li class="list-peliculas"><a href="#aventura">Aventura</a></li>
                    <li class="list-peliculas"><a href="#terror">Terror</a></li>
                    <li class="list-peliculas"><a href="#drama">Drama</a></li>
                </ul>
                <ul class="categoriaspe">
                    <li class="list-peliculas"><a href="#suspenso">Suspenso</a></li>
                    <li class="list-peliculas"><a href="#belico">Bélico</a></li>
                    <li class="list-peliculas"><a href="#ficcion">Ficción</a></li>
                </ul>
                
            </div>
            <div class="series">
                <br>
                <h4>Series</h4>
                <ul class="categoriase">
                    <li class="list-series"><a href="500.html">Acción</a></li>
                    <li class="list-series"><a href="#">Romance</a></li>
                    <li class="list-series"><a href="#">Familiar</a></li>
                </ul>
                <ul class="categoriase">
                    <li class="list-series"><a href="#">Aventura</a></li>
                    <li class="list-series"><a href="#">Terror</a></li>
                    <li class="list-series"><a href="#">Drama</a></li>
                </ul>
                <ul class="categoriase">
                    <li class="list-series"><a href="#">Suspenso</a></li>
                    <li class="list-series"><a href="#">Bélico</a></li>
                    <li class="list-series"><a href="#">Ficción</a></li>
                </ul>
            </div>
            <div class="recomendado">
                <ul class="recomendlist">
                    <br>
                    <li class="list-reco"><a href="#">Recomendado</a></li>
                    <li class="list-reco"><a href="#">Lo Mas Visto</a></li>
                    <br>
                </ul>
            </div>
            <div class="mod">
            <div class="seccion">
                <a href="#"><i class='bx bx-crown sub'></i></a>
                <p>Suscribete</p>
            </div>
            <div class="seccion">
                <a href="#"><i class='bx bx-cog sop'></i></a>
                <p>soporte</p>
            </div>
        </div>
        </nav>
    </div>
    <div class="contenidope">
        <i id="accion"></i>
        <br><br><br><br>
        <h5>Accion</h5>
        <div class="wrapper">
            <i id="left" class="fa-solid fa-angle-left"></i>
                <div class="carrusel">
                    <?php
                    // Conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "nixer";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Obtener las películas del género de acción
                    $sql = "SELECT * FROM peliculas WHERE genero = (SELECT id_categoria FROM categorias WHERE nombre_categoria = 'accion')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id_pelicula = $row['id_pelicula'];
                            $imagen = $row['imagen'];
                            echo '<a href="reproductor.php?id=' . $id_pelicula . '"><img src="' . $imagen . '" alt="img" draggable="false"></a>';
                        }
                    } else {
                        echo "<p>No se encontraron películas de acción.</p>";
                    }

                    $conn->close();
                    ?>
                </div>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
        <i id="aventura"></i>
        <br><br><br><br><br>
        <h5>Aventura</h5><br><br>
        <div class="wrapper2">
            <i id="left" class="fa-solid fa-angle-left"></i>
            <div class="carrusel2">
            <?php
                    // Conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "nixer";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Obtener las películas del género de acción
                    $sql = "SELECT * FROM peliculas WHERE genero = (SELECT id_categoria FROM categorias WHERE nombre_categoria = 'aventura')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id_pelicula = $row['id_pelicula'];
                            $imagen = $row['imagen'];
                            echo '<a href="reproductor.php?id=' . $id_pelicula . '"><img src="' . $imagen . '" alt="img" draggable="false"></a>';
                        }
                    } else {
                        echo "<p>No se encontraron películas de acción.</p>";
                    }

                    $conn->close();
                    ?>
            </div>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
        <i id="suspenso"></i>
        <br><br><br><br><br>
        <h5>Suspenso</h5><br><br>
        <div class="wrapper3">
            <i id="left" class="fa-solid fa-angle-left"></i>
            <div class="carrusel3">
            <?php
                    // Conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "nixer";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Obtener las películas del género de acción
                    $sql = "SELECT * FROM peliculas WHERE genero = (SELECT id_categoria FROM categorias WHERE nombre_categoria = 'suspenso')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id_pelicula = $row['id_pelicula'];
                            $imagen = $row['imagen'];
                            echo '<a href="reproductor.php?id=' . $id_pelicula . '"><img src="' . $imagen . '" alt="img" draggable="false"></a>';
                        }
                    } else {
                        echo "<p>No se encontraron películas de acción.</p>";
                    }

                    $conn->close();
                    ?>
            </div>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
        <i id="romance"></i>
        <br><br><br><br><br>
        <h5>Romance</h5><br><br>
        <div class="wrapper4">
            <i id="left" class="fa-solid fa-angle-left"></i>
            <div class="carrusel4">
            <?php
                    // Conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "nixer";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Obtener las películas del género de acción
                    $sql = "SELECT * FROM peliculas WHERE genero = (SELECT id_categoria FROM categorias WHERE nombre_categoria = 'romance')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id_pelicula = $row['id_pelicula'];
                            $imagen = $row['imagen'];
                            echo '<a href="reproductor.php?id=' . $id_pelicula . '"><img src="' . $imagen . '" alt="img" draggable="false"></a>';
                        }
                    } else {
                        echo "<p>No se encontraron películas de acción.</p>";
                    }

                    $conn->close();
                    ?>
            </div>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
        <i id="terror"></i>
        <br><br><br><br><br>
        <h5>Terror</h5><br><br>
        <div class="wrapper5">
            <i id="left" class="fa-solid fa-angle-left"></i>
            <div class="carrusel5">
            <?php
                    // Conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "nixer";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Obtener las películas del género de acción
                    $sql = "SELECT * FROM peliculas WHERE genero = (SELECT id_categoria FROM categorias WHERE nombre_categoria = 'terror')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id_pelicula = $row['id_pelicula'];
                            $imagen = $row['imagen'];
                            echo '<a href="reproductor.php?id=' . $id_pelicula . '"><img src="' . $imagen . '" alt="img" draggable="false"></a>';
                        }
                    } else {
                        echo "<p>No se encontraron películas de acción.</p>";
                    }

                    $conn->close();
                    ?>
            </div>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
        <i id="belico"></i>
        <br><br><br><br><br>
        <h5>Belico</h5><br><br>
        <div class="wrapper6">
            <i id="left" class="fa-solid fa-angle-left"></i>
            <div class="carrusel6">
            <?php
                    // Conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "nixer";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Obtener las películas del género de acción
                    $sql = "SELECT * FROM peliculas WHERE genero = (SELECT id_categoria FROM categorias WHERE nombre_categoria = 'belico')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id_pelicula = $row['id_pelicula'];
                            $imagen = $row['imagen'];
                            echo '<a href="reproductor.php?id=' . $id_pelicula . '"><img src="' . $imagen . '" alt="img" draggable="false"></a>';
                        }
                    } else {
                        echo "<p>No se encontraron películas de acción.</p>";
                    }

                    $conn->close();
                    ?>
            </div>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
        <i id="familiar"></i>
        <br><br><br><br><br>
        <h5>Familiar</h5><br><br>
        <div class="wrapper7">
            <i id="left" class="fa-solid fa-angle-left"></i>
            <div class="carrusel7">
            <?php
                    // Conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "nixer";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Obtener las películas del género de acción
                    $sql = "SELECT * FROM peliculas WHERE genero = (SELECT id_categoria FROM categorias WHERE nombre_categoria = 'familiar')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id_pelicula = $row['id_pelicula'];
                            $imagen = $row['imagen'];
                            echo '<a href="reproductor.php?id=' . $id_pelicula . '"><img src="' . $imagen . '" alt="img" draggable="false"></a>';
                        }
                    } else {
                        echo "<p>No se encontraron películas de acción.</p>";
                    }

                    $conn->close();
                    ?>
            </div>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
        <i id="drama"></i>
        <br><br><br><br><br>
        <h5>Drama</h5><br><br>
        <div class="wrapper8">
            <i id="left" class="fa-solid fa-angle-left"></i>
            <div class="carrusel8">
            <?php
                    // Conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "nixer";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Obtener las películas del género de acción
                    $sql = "SELECT * FROM peliculas WHERE genero = (SELECT id_categoria FROM categorias WHERE nombre_categoria = 'drama')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id_pelicula = $row['id_pelicula'];
                            $imagen = $row['imagen'];
                            echo '<a href="reproductor.php?id=' . $id_pelicula . '"><img src="' . $imagen . '" alt="img" draggable="false"></a>';
                        }
                    } else {
                        echo "<p>No se encontraron películas de acción.</p>";
                    }

                    $conn->close();
                    ?>
            </div>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
        <i id="ficcion"></i>
        <br><br><br><br><br>
        <h5>ficcion</h5><br><br>
        <div class="wrapper9">
            <i id="left" class="fa-solid fa-angle-left"></i>
            <div class="carrusel9">
            <?php
                    // Conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "nixer";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Obtener las películas del género de acción
                    $sql = "SELECT * FROM peliculas WHERE genero = (SELECT id_categoria FROM categorias WHERE nombre_categoria = 'ficcion')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id_pelicula = $row['id_pelicula'];
                            $imagen = $row['imagen'];
                            echo '<a href="reproductor.php?id=' . $id_pelicula . '"><img src="' . $imagen . '" alt="img" draggable="false"></a>';
                        }
                    } else {
                        echo "<p>No se encontraron películas de acción.</p>";
                    }

                    $conn->close();
                    ?>
            </div>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
    </div>
</body>
</html>