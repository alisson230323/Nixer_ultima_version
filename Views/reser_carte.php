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
      <link rel="stylesheet" href="css/carte.css">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <title>Gestión de reservas</title>
  </head>
  <body>
      
      <header class="bar-lat">
          
          <img src="img/logo 1.png" alt=""> 
          <nav>
      <a href="admin_reser.php">  <i class='bx bx-calendar-event bx-md' ></i><li >Reservas</li></a><br><br><br>
      <a href="reser_carte"><i class='bx bx-slideshow bx-md'></i><li>Cartelera</li></a><br><br><br>
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

// Consultar la información de las peliculas
$sqlcine = "SELECT * From  cine";
$resultcine = $conn->query($sqlcine);

// Mostrar la información de las reservas en una tabla con clases CSS
echo "<h2  class='topp'>CONTENIDO EN CARTELERA</h2>";
echo "<table class='reservas-table'>";
echo "<tr><th>imagen</th><th>titulo</th><th>duracion</th><th>descripcion</th><th>genero</th><th>clasificacion</th><th>Editar</th><th>Eliminar  </th></tr>";
while ($cine= $resultcine->fetch_assoc()) {
    echo "<tr>";
    echo "<td><img src='" . $cine['imagen'] . "' class='movie-image'></td>";
    echo "<td>" . $cine['titulo'] . "</td>";
    echo "<td>" . $cine['duracion'] . "</td>";
    echo "<td>" . $cine['descripcion'] . "</td>";
    echo "<td>" . $cine['genero'] . "</td>";
    echo "<td>" . $cine['clasificacion'] . "</td>";
    echo "<td><button class='edit-button' data-id='" . $cine['id_cine_peli'] . "' onclick='openEditModal(this)'><i class='bx bxs-pencil bx-xs'></i></button></td>";
    echo "<td><button class='delete-button' data-id='" . $cine['id_cine_peli'] . "' onclick='confirmDelete(this)'><i class='bx bxs-trash bx-xs'></i></button></td>";
    echo "</tr>";
}
echo "</table>";

// Cerrar la conexión
$conn->close();
?>

 <button type="button" id="btn-modal1"  class="btn-reserva" onclick="abrirModal('modal1')">Agregar contenido </button>

<!--- modal para agregar contenido --->
<form action=" /Controller/Reserva/agre_carte.php" method="POST" enctype="multipart/form-data">
    <div id="modal1" class="modal">
        <header class="modal-content1">
          <h2>Datos del contenido</h2>
          <a onclick="cerrarModal()">X</a>
        </header>
          <div class="modal-content">
       
              <div class="pos-nom">
              <p><b>Titulo</b></p>
              <input class="nom-titu" type="text" name="titulo" id="myInput"  placeholder="Nombre de la pelicula"required><br><br>
              </div>
              
              <div class="pos-num">
              <p><b>Duración</b></p>
              <input class="nom-titu" type="number" name="duracion" id="" placeholder="minutos de duracion"required><br><br>
              </div>


              <div class="pos-num1">
              <p><b>Descripción</b></p>
              <input class="nom-titu1" type="text" name="descripcion" id="" placeholder="Una breve descripcion de la pelicula"required><br><br>
              </div>



              
              <div class="pos-fe">
              <p><b> &nbsp &nbsp Genero &nbsp &nbsp &nbsp Clasificación</b></p>
              <input class="fecha-exp" type="text" name="genero" id="" placeholder="Acción"required> 
              &nbsp
              <input class="fecha-exp" type="text" name="clasificacion" id="" placeholder="pg-13"required><br><br>
              </div>

              <div class="pos-cod">
              <p><b>Imagen que se mostrara en cartelera</b></p>
              <input class="cod-seg" type="file" name="imagen" id="" required><br><br>
              </div>


              <input type="submit" class="reserver" value="Agregar">
          </div>
      </div>
     </form>



     <!--- modal para editar el contenido --->
<form action=" /Controller/Reserva/edit_carte.php" method="POST" enctype="multipart/form-data">
    <div id="btn-modal2" class="modal">
        <header class="modal-content1">
          <h2>Editar datos del contenido</h2>
          <a onclick="cerrarModal()">X</a>
        </header>
          <div class="modal-content">
       
              <div class="pos-nom">
              <p><b>Titulo</b></p>
              <input class="nom-titu" type="text" name="titulo" id="myInput"  placeholder="Nombre de la pelicula"required><br><br>
              </div>
              
              <div class="pos-num">
              <p><b>Duración</b></p>
              <input class="nom-titu" type="number" name="duracion" id="editDuracion" placeholder="minutos de duracion"required><br><br>
              </div>


              <div class="pos-num1">
              <p><b>Descripción</b></p>
              <input class="nom-titu1" type="text" name="descripcion" id="editDescripcion" placeholder="Una breve descripcion de la pelicula"required><br><br>
              </div>



              
              <div class="pos-fe">
              <p><b> &nbsp &nbsp Genero &nbsp &nbsp &nbsp Clasificación</b></p>
              <input class="fecha-exp" type="text" name="genero" id="editGenero" placeholder="Acción"required> 
              &nbsp
              <input class="fecha-exp" type="text" name="clasificacion" id="editClasificacion" placeholder="pg-13"required><br><br>
              </div>

              <div class="pos-cod">
              <p><b>Imagen que se mostrara en cartelera</b></p>
              <input class="cod-seg" type="file" name="imagen" id="" required><br><br>
              </div>


              <input type="submit" class="reserver" value="Agregar">
          </div>
      </div>
     </form>




     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </body>
  </html>





  <script>
    // Función para abrir el modal de edición
    function openEditModal(button) {
        var idCinePeli = button.getAttribute('data-id');

        // Obtener la información del registro correspondiente
        $.ajax({
            url: '/Controller/Reserva/get_carte.php',
            type: 'POST',
            data: {id_cine_peli: idCinePeli},
            dataType: 'json',
            success: function(response) {
                // Llenar los campos del formulario con los datos del registro
                $('#myInput').val(response.titulo);
                $('#editDuracion').val(response.duracion);
                $('#editDescripcion').val(response.descripcion);
                $('#editGenero').val(response.genero);
                $('#editClasificacion').val(response.clasificacion);
                // Abre el modal
                openModal('btn-modal2');
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    // Funciones para abrir y cerrar el modal
    function openModal(modalId) {
        document.getElementById(modalId).style.display = "block";
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    // Función para confirmar la eliminación
    function confirmDelete(button) {
        var idCinePeli = button.getAttribute('data-id');

        if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
            // Realizar la eliminación
            $.ajax({
                url: '/Controller/Reserva/delete_carte.php',
                type: 'POST',
                data: {id_cine_peli: idCinePeli},
                success: function(response) {
                    // Actualizar la tabla de reservas
                    // ...
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
    }
</script>

















 <!--- script para abrir modales-->
  <script> 
    function abrirModal(modalId) {
       const modal = document.getElementById(modalId);
       modal.style.display = "block";

       modal.classList.add("slide-in");
       modal.classList.add("show");
    }
     
    function cerrarModal() {
       const modals = document.getElementsByClassName("modal");
       for (let i = 0; i < modals.length; i++) {
         modals[i].style.display = "none";
       }
    }
</script>

<!----  script para eliminar contenido-->
<script>
function confirmDelete(button) {
  var confirmDelete = confirm("¿Estás seguro de que deseas eliminar este registro?");

  if (confirmDelete) {
    var id = button.getAttribute('data-id');
    // Realiza una solicitud AJAX para eliminar el registro utilizando el ID
    $.ajax({
      url: '/Controller/Reserva/eliminar_conte.php',
      type: 'POST',
      data: { id: id },
      success: function(response) {
        // La eliminación se completó correctamente
        alert(response);
        // Actualizar la tabla
        location.reload();
      },
      error: function(xhr, status, error) {
        // Ocurrió un error durante la eliminación
        alert("Error al eliminar el registro: " + error);
      }
    });
  }
}
</script>
