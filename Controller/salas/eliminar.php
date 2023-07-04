<?php

include("conexion.php");

if(isset($_GET['id_sala'])){
    $id_sala = $_GET['id_sala'];
    $query = "DELETE FROM sala WHERE id_sala = $id_sala";
    $resultado = mysqli_query($conn, $query);
    if (!$resultado){
        die("Ha fallado");
    }

    $_SESSION['message'] = 'Eliminado Correctamente';
    $_SESSION['message_type'] = 'danger';

    header("Location: /Views/sala.php");
}

?>