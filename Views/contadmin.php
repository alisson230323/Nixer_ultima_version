<?php
// Incluir el archivo para verificar la sesión
include '../Controller/val_reg/verificar_sesion.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Películas y Series</title>
    <link rel="stylesheet" type="text/css" href="css/contadmin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <?php
    if (isset($_GET['mensaje'])) {
        $mensaje = $_GET['mensaje'];
        echo "<script>alert('$mensaje');</script>";
    }
    ?>
</head>
<body>
<header class="bar-lat">
        
        <img src="/img/logo 1.png" alt=""> 
        <nav>
        <a href=" /Controller/val_reg/logout.php"> <i class='bx bx-log-out bx-md' ></i><li >Cerrar sesion</li></a> <br><br><br><br><br>   
      <a href=""><i class='bx bx-slideshow bx-md'></i><li>Peliculas</li></a><br><br><br><br><br>
      <a href=""><i class='bx bxs-caret-right-circle bx-md'></i><li>Series</li></a><br><br><br><br><br>
      <a href=""> <i class='bx bx-cog bx-md' ></i><li >Soporte</li></a><br><br><br><br><br>
      <a href=""> <i class='bx bx-user-circle bx-md' ></i><li >Perfil</li></a>
     
    </nav>
    </header>

<div class="en">
    <h1>Películas y Series</h1>

    <!-- Formulario para agregar una película o serie -->
    <button type="button" id="abrirModal" class="btn btn-primary" style="background-color:  hsl(300, 100%, 25%); 
    width:10%; height:60px; border:none; position:relative; left:80%;
    top: 60px;">Agregar Película o Serie </button>

    <!-- Ventana modal -->
    <div class="modal" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="modalAgregarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarLabel">Agregar Película o Serie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario -->
                    <form action="/Controller/php/create.php" method="POST">
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="nombre" required><br>

                        <label for="categoria">Categoría:</label>
                        <select name="genero" id="categoria">
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "nixer";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            // Consultar las categorías utilizando la FOREIGN KEY
                            $query = "SELECT id_categoria, nombre_categoria FROM categorias";
                            $result = $conn->query($query);

                            // Generar las opciones del select
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $id_categoria = $row['id_categoria'];
                                    $nombre_categoria = $row['nombre_categoria'];
                                    echo "<option value=\"$id_categoria\">$nombre_categoria</option>";
                                }
                            } else {
                                echo "<option value=\"\">No se encontraron categorías</option>";
                            }

                            // Cerrar conexión
                            $conn->close();
                            ?>
                        </select><br>

                        <label for="anio">Año:</label>
                        <input type="number" id="anio" name="anio" required><br>

                        <label for="sinopsis">Sinopsis:</label>
                        <textarea id="sinopsis" name="sinopsis" required></textarea><br>

                        <label for="duracion">Duración (minutos):</label>
                        <input type="number" id="duracion" name="duracion" required><br>

                        <label for="imagen">Imagen:</label>
                        <input type="url" id="imagen" name="imagen" required><br>

                        <label for="url">URL:</label>
                        <input type="url" id="url" name="url" required><br>

                        <label for="url_trailer">URL del Trailer:</label>
                        <input type="url" id="url_trailer" name="url_trailer" required><br>

                        <input type="submit" value="Agregar">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="encabezado">
    <!-- Formulario de búsqueda -->
    <form method="GET" action="" class="buscar">
        <input type="text" name="busqueda" placeholder="Buscar...">
        <input type="submit" value="Buscar" style="background-color:  hsl(300, 100%, 25%);">
    </form>
    <br><br>
    </div>
    
    <!-- Tabla para mostrar las películas y series -->
    <!-- Tabla para mostrar las películas -->
        <table>
            <tr>
                <th style="font-size: 10px;" >Título</th>
                <th style="font-size: 10px;">Género</th>
                <th style="font-size: 10px;">Año</th>
                <th style="font-size: 10px;">Sinopsis</th>
                <th style="font-size: 10px;">Duración</th>
                <th style="font-size: 10px;">Imagen</th>
                <th style="font-size: 10px;">URL</th>
                <th style="font-size: 10px;">URL del Trailer</th>
                <th style="font-size: 10px;">Acciones</th>
            </tr>

                <?php
                // Mostrar registros de la base de datos
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "nixer";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Obtener el término de búsqueda ingresado por el usuario
                $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

                // Consulta para obtener los registros filtrados por el término de búsqueda
                $sql = "SELECT * FROM peliculas WHERE nombre LIKE '%$busqueda%' OR genero LIKE '%$busqueda%'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td style=\"font-size: 10px;\">" . $row['nombre'] . "</td>";
                        echo "<td style=\"font-size: 10px;\">" . $row['genero'] . "</td>";
                        echo "<td style=\"font-size: 10px;\">" . $row['anio'] . "</td>";
                        echo "<td style=\"font-size: 10px;\">" . $row['sinopsis'] . "</td>";
                        echo "<td style=\"font-size: 10px;\">" . $row['duracion'] . " minutos</td>";
                        echo "<td>";
                        echo '<img src="' . $row['imagen'] . '" alt="" style="width: 80px; height: auto; border-radius: 5px;">';
                        echo "</td>";
                        echo "<td style=\"font-size: 10px;\">" . $row['url'] . "</td>";
                        echo "<td style=\"font-size: 10px;\">" . $row['url_trailer'] . "</td>";
                        echo "<td>";
                        echo "<a href='/Controller/php/update.php?id=" . $row['id_pelicula'] . "'>Actualizar</a> ";
                        echo "<a href='/Controller/php/delete.php?id=" . $row['id_pelicula'] . "'>Eliminar</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No se encontraron registros</td></tr>";
                }
                $conn->close();
                ?>
        </table>


    <!-- Importar las librerías de Bootstrap y jQuery -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

    <script>
        // Abrir la ventana modal al hacer clic en el botón
        $(document).ready(function() {
            $("#abrirModal").click(function() {
                $("#modalAgregar").modal("show");
            });
        });
    </script>
</body>
</html>