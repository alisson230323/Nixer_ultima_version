<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Iniciar Sesión</title>

</head>
<body>
<div id="contenedor">

    <div class="head">
        <div class="logo">
            <a href="index.php"><img src="img/logo 1.png" alt=""></a>
        </div>
        <div class="menu">
            <a href="#"></a>
        </div>
    </div>
    <section class="form-register">
        <h4>Login</h4>
        <style>
            .alert {
                display: none;
                position: absolute;
                background-color: purple;
                color: white;
                padding: 10px;
                border-radius: 5px;
                margin-top: 5px;
                opacity: 1;
                transition: opacity 2s ease-out;
            }
        
            .alert.fade-out {
                opacity: 0;
            }
        </style>
        
        <form name="formulario" id="formulario" method="POST" action="/Controller/val_reg/validar_usu.php" onsubmit="return validarFormulario()" autocomplete="off">

            <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su correo" autocomplete="off">
            <div id="correoAlert" class="alert"></div>

            <input class="controls" type="password" name="contrasena" id="contraseña" placeholder="Ingrese su contraseña" autocomplete="off">
            <div id="contraseñaAlert" class="alert"></div>

            <input class="registrador" type="submit" value="iniciar sesion">

            <p><a href="registro.php">¿No tienes cuenta?</a></p>
            <p><a href="#">Recuperar contraseña</a></p>
        </form>
        
        <script>
            function validarFormulario() {
                var correo = document.getElementById('correo').value;
                var contraseña = document.getElementById('contraseña').value;
        
                // Validar campos vacíos
                if (correo === '') {
                    mostrarAlerta('correoAlert', 'Por favor, ingrese su correo electrónico.');
                    return false; // Evita el envío del formulario
                }
        
                if (contraseña === '') {
                    mostrarAlerta('contraseñaAlert', 'Por favor, ingrese su contraseña.');
                    return false; // Evita el envío del formulario
                }
        
                // Validar inyecciones de SQL
                var correoPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if (!correoPattern.test(correo)) {
                    mostrarAlerta('correoAlert', 'Por favor, ingrese un correo electrónico válido.');
                    return false; // Evita el envío del formulario
                }
        
                return true; // Permite el envío del formulario
            }
        
            function mostrarAlerta(alertId, mensaje) {
                var alertElement = document.getElementById(alertId);
                alertElement.innerHTML = mensaje;
                alertElement.style.display = 'block';
        
                setTimeout(function () {
                    alertElement.classList.add('fade-out');
                    setTimeout(function () {
                        alertElement.style.display = 'none';
                        alertElement.classList.remove('fade-out');
                    }, 500); // 2 segundos
                }, 500); // 2 segundos
            }
        </script>
        
    </section>


        <footer class="pie-pagina">
            <div class="grupo-1">
                <div class="box">
                    <figure>
                        <a href="#">
                            <img src="img/logo 1.png" alt="Logo de SLee Dw">
                        </a>
                    </figure>
                </div>
                <div class="box">
                    <h2>SOBRE NOSOTROS</h2>
                    <p>3211547823</p>
                    <p>SYSNIXER@gmail.com</p>
                    <p>kr170 #23-63</p>
                </div>
            </div>
            <div class="grupo-2">
                <small>&copy; 2022 <b>NIXER company</b> - Todos los Derechos Reservados.</small>
            </div>
        </footer>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

        <script src="main.js"></script>
</div>

</body>
</html>