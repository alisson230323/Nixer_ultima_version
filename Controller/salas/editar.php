<?php
include("conexion.php");

$nombre = '';
$descripcion = '';
$nombre_usuario = '';

if (isset($_GET['id_sala'])) {
  $id_sala = $_GET['id_sala'];
  $query = "SELECT * FROM sala WHERE id_sala = $id_sala";
  $resultado = mysqli_query($conn, $query);
  if (mysqli_num_rows($resultado) == 1) {
    $row = mysqli_fetch_array($resultado);
    $nombre = $row['nombre'];
    $descripcion = $row['descripcion'];
    $nombre_usuario = $row['lista_usuarios']; // Agregar esta línea para obtener el valor del nombre de usuario
  }
  
}

if (isset($_POST['update'])) {
    $id_sala = $_GET['id_sala'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $nombre_usuario = $_POST['nombre_usuario']; // Agregar esta línea para obtener el valor del campo nombre_usuario del formulario

    $query = "UPDATE sala SET nombre = '$nombre', descripcion = '$descripcion', lista_usuarios = '$nombre_usuario' WHERE id_sala = $id_sala";
    mysqli_query($conn, $query);
    $_SESSION['message'] = 'Cambio Exitoso';
    $_SESSION['message_type'] = 'warning';
    header('Location: /Views/sala.php');
}


?>

<?php include(' /Views/includes/encabezado.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="editar.php?id_sala=<?php echo $_GET['id_sala']; ?>" method="POST">
    <div class="form-group">
        <h2>Editar Sala</h2>
        <input name="nombre_usuario" type="text" class="form-control" value="<?php echo $nombre_usuario; ?>" placeholder="Nombre del usuario">
    </div>
    <div class="form-group">
        <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" placeholder="Nombre de la sala">
    </div>
    <div class="form-group">
        <textarea name="descripcion" class="form-control" cols="30" rows="5"><?php echo $descripcion;?></textarea>
    </div>
    <button class="btn btn-success boton-2" type="submit" name="update">
        Guardar
    </button>
</form>

      </div>
    </div>
  </div>
</div>
<?php include('/Views/includes/footer.php'); ?>
