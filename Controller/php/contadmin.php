
<!DOCTYPE html>
<html>
<head>
    <title>Películas y Series</title>
    <link rel="stylesheet" type="text/css" href="contadmin.css">
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
     <a href="">  <i class='bx bx-line-chart bx-md' ></i><li >Analisis</li></a> 
      <a href=""> <i class='bx bx-category-alt bx-md' ></i><li >Categoria </li></a>
      <a href=""><i class='bx bx-slideshow bx-md'></i><li>Peliculas</li></a>
      <a href=""><i class='bx bxs-caret-right-circle bx-md'></i><li>Series</li></a>
      <a href=""><i class='bx bxs-user-account bx-md' style='color:#ffffff'></i><li>Usuarios</li></a>
      <a href=""> <i class='bx bx-calendar-week bx-rotate-90 bx-md' ></i><li >Reservas </li></a>
      <a href=""> <i class='bx bx-crown bx-md'></i><li >Planes</li></a>
      <a href=""><i class='bx bx-money-withdraw bx-md'></i><li>Pagos</li></a>
      <a href=""> <i class='bx bx-cog bx-md' ></i><li >Soporte</li></a>
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
                    <form action="create.php" method="POST">
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" required><br>

                        <label for="genero">Género:</label>
                        <input type="text" id="genero" name="genero" required><br>

                        <label for="anio">Año:</label>
                        <input type="number" id="anio" name="anio" required><br>

                        <label for="sinopsis">Sinopsis:</label>
                        <textarea id="sinopsis" name="sinopsis" required></textarea><br>

                        <label for="duracion">Duración (minutos):</label>
                        <input type="number" id="duracion" name="duracion" required><br>

                        <label for="imagen">Imagen:</label>
                        <input type="url" id="imagen" name="imagen" required><br>

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
    <table>
        <tr>
            <th>Título</th>
            <th>Género</th>
            <th>Año</th>
            <th>Sinopsis</th>
            <th>Duración</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>

        <?php
        // Mostrar registros de la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "contad";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die

("Conexión fallida: " . $conn->connect_error);
        }

        // Obtener el término de búsqueda ingresado por el usuario
        $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

        // Consulta para obtener los registros filtrados por el término de búsqueda
        $sql = "SELECT * FROM peliculas_series WHERE titulo LIKE '%$busqueda%' OR genero LIKE '%$busqueda%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['titulo'] . "</td>";
                echo "<td>" . $row['genero'] . "</td>";
                echo "<td>" . $row['anio'] . "</td>";
                echo "<td>" . $row['sinopsis'] . "</td>";
                echo "<td>" . $row['duracion'] . " minutos</td>";
                echo "<td>";
                echo '<img src="' . $row['imagen'] . '" alt="" style="width: 100px; height: auto; border-radius: 5px; border: 1px solid #ccc; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">';
                echo "</td>";
                echo "<td>";
                echo "<a href='update.php?id=" . $row['id'] . "'>Actualizar</a> ";
                echo "<a href='delete.php?id=" . $row['id'] . "'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No se encontraron registros</td></tr>";
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