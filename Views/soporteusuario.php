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
    <link rel="stylesheet" href="css/soporteusuario.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>panel de soporte</title>
</head>
<body>
    
<header class="bar-lat">
    <nav>
        <a href="pre-dashboard.php"><i class='bx bx-arrow-back bx-lg'></i><li>regresar</li></a>
        <a href=""><i class='bx bx-user-circle bx-lg'></i><li>Perfil</li></a>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <a href=""><i class='bx bx-cog'></i><li class="">Soporte</li></a>
    </nav>
    <img class="logo" src="img/logo 1.png" alt=""> 
</header>

<div class="contenedor">
    <div class="texto">
        <p>SOPORTE</p>
    </div>
</div>

<section class="catalogo">
    <div class="contenedorsuport">
        <form action=" /Controller/php/guarsup.php" method="POST">
            <h2>Registro de problemas</h2>
            <h2></h2>
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>
            <label for="description">Descripción del problema:</label>
            <textarea id="description" name="description" required></textarea>
            <button type="submit">Enviar</button>
        </form>
    </div>

    <div class="preguntasfre">
        <h1>Preguntas Frecuentes</h1>
        <ul>
            <li>¿Cómo restablezco mi contraseña?</li>
            <h2></h2>
            <li>¿Cómo actualizo mi información de cuenta?</li>
            <h2></h2>
            <li>¿Cómo puedo contactar al soporte técnico?</li>
            <h2></h2>
            <li>¿Cómo puedo cambiar mi contraseña?</li>
            <h2></h2>
            <li>¿Cómo puedo cambiar mi número de teléfono?</li>
            <h2></h2>
            <li>¿Cómo puedo modificar mi foto de perfil?</li>
            <h2></h2>
        </ul>
    </div>
</section>

</body>
</html>
