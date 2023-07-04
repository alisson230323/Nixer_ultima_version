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
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Contenido</title>
</head>
<body>
    <div class="box1">
        <img src="img/usuario.png">
        <div class="back">
        <a href=" /Controller/val_reg/logout.php">Cerrar sesión</a>

        </div>
    </div>
    
    <div class="menu">
        <h2>BIENVENIDO</h2><br><br><br>
        <div class="categorias">
            <a href="contenido.php"><img src="img/categorias.webp"></a> |
            <p>CONTENIDO</p>
        </div>
        <div class="reservas">       
            <a href="reservasusuario.php"><img src="img/reservas.webp"></a>
            <p>RESERVAS</p>
        </div>
        <div class="soporte">
            <a href="soporteusuario.php"><img src="img/soporte.webp"></a>
            <p>SOPORTE</p>
        </div>
        <div class="vip">
            <a href="suscripcion.html"><img src="img/vip.webp" ></a>
            <p>SUSCRIPCIONES</p>
        </div>
    </div>
    <footer>
        <img src="img/logo.webp" alt="">
    </footer>
</body>
</html>