<?php
$host = "localhost";
$user = "root";
$password = "";
$bd = "nixer";


$conn =mysqli_connect($host, $user, $password, $bd); 

include("includes/encabezado.php");
?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 formulario">
            <?php if(isset($_SESSION['message'])): ?>
                <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php session_unset(); ?>
            <?php endif; ?>

            <div class="card card-body cuerpo">
            <h2>Crea tu Nueva Sala</h2>
            <form id="myForm" action="/Controller/salas/guardar.php" method="POST" onsubmit="return validateForm()">
                    <div class="form-group">
                        <input type="text" name="nombre_usuario" class="form-control" placeholder="Nombre del usuario" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre de la sala">
                    </div>
                    <div class="form-group">
                        <textarea name="descripcion" rows="2" class="form-control" placeholder="Descripción de la sala"></textarea>
                    </div>
                    <input type="submit" class="btn btn-success btn-block boton" name="save_task" value="Guardar">
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <table class="table table-bordered tabla-border">
                <thead>
                    <tr>
                        <th>Nombre de la sala</th>
                        <th>Descripción</th>
                        <th>Usuario</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT sala.*, sala.lista_usuarios AS lista_usuarios FROM sala";
                    $resultado_sala = mysqli_query($conn, $query);

                    if (!$resultado_sala) {
                        die("Error en la consulta: " . mysqli_error($conn));
                    }

                    while ($row = mysqli_fetch_array($resultado_sala)) :
                    ?>
                        <tr>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['descripcion']; ?></td>
                            <td><?php echo $row['lista_usuarios']; ?></td>
                            <td>
                                <a href="/Controller/salas/editar.php?id_sala=<?php echo $row['id_sala']; ?>" class="btn btn-secondary">
                                    <i class="fas fa-marker"></i>
                                </a>
                                <a href="/Controller/salas/eliminar.php?id_sala=<?php echo $row['id_sala']; ?>" class="btn btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

