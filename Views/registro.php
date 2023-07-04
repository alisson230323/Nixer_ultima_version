<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/registro.css">
    <title>NIXER</title>

</head>
<body>
<div id="contenedor">

    <div class="head"> 
        <div class="logo">
            <a href="./index.php"><img src="img/logo 1.png" alt=""></a>
        </div>
        <div class="menu">
            <a href="#"></a>
        </div>
    </div>
    <section class="form-register">
        <h4>Formulario de Registro</h4>
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
        
        <form name="formulario" id="formulario" action="/Controller/val_reg/registro_usu.php" method="post" onsubmit="return validarFormulario()" autocomplete="off">

            <input class="controls" type="number" name="identificacion" id="identificacion" placeholder="Ingrese su Identificación" autocomplete="off">
            <div id="identificacionAlert" class="alert"></div>
    
            <input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese su Nombre" autocomplete="off">
            <div id="nombreAlert" class="alert"></div>

            <input class="controls" type="text" name="apellidos" id="apellidos" placeholder="Ingrese su Apellido" autocomplete="off">
            <div id="apellidosAlert" class="alert"></div>

            <input class="controls" type="number" name="telefono" id="telefono" placeholder="Ingrese su número de teléfono" autocomplete="off">
            <div id="telefonoAlert" class="alert"></div>

            <input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese su correo electrónico" autocomplete="off">
            <div id="correoAlert" class="alert"></div>

            <input class="controls" type="password" name="contrasena" id="contrasena" placeholder="Ingrese su contraseña" autocomplete="off" onkeyup="validarContrasena()">
            <div id="contrasenaAlert" class="alert"></div>

            <p><a href="#">Terminos y Condiciones</a></p>
            <input class="registrador" type="submit" value="Registrar">
            <p>¿Ya tengo Cuenta?<br><a href="./login.html">Iniciar sesión</a></p>
        </form>
        <script>
            function validarFormulario() {
                var identificacion = document.getElementById('identificacion').value;
                var nombre = document.getElementById('nombre').value;
                var apellidos = document.getElementById('apellidos').value;
                var telefono = document.getElementById('telefono').value;
                var correo = document.getElementById('correo').value;
                var contrasena = document.getElementById('contrasena').value;
        
                // Validar campos vacíos
                if (identificacion === '') {
                    mostrarAlerta('identificacionAlert', 'Por favor, ingrese su identificación.');
                    return false; // Evita el envío del formulario
                }
        
                if (nombre === '') {
                    mostrarAlerta('nombreAlert', 'Por favor, ingrese su nombre.');
                    return false; // Evita el envío del formulario
                }
        
                if (apellidos === '') {
                    mostrarAlerta('apellidosAlert', 'Por favor, ingrese su apellido.');
                    return false; // Evita el envío del formulario
                }
        
                if (telefono === '') {
                    mostrarAlerta('telefonoAlert', 'Por favor, ingrese su número de teléfono.');
                    return false; // Evita el envío del formulario
                }
        
                if (correo === '') {
                    mostrarAlerta('correoAlert', 'Por favor, ingrese su correo electrónico.');
                    return false; // Evita el envío del formulario
                }
        
                if (contrasena === '') {
                    mostrarAlerta('contrasenaAlert', 'Por favor, ingrese su contraseña.');
                    return false; // Evita el envío del formulario
                }
        
                // Validar formato de correo electrónico
                var correoPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                if (!correoPattern.test(correo)) {
                    mostrarAlerta('correoAlert', 'Por favor, ingrese un correo electrónico válido.');
                    return false; // Evita el envío del formulario
                }
        
                // Validar contraseña
                var contrasenaPattern = /^(?=.*[A-Z]).{8,}$/;
                if (!contrasenaPattern.test(contrasena)) {
                    mostrarAlerta('contrasenaAlert', 'La contraseña debe tener al menos 8 caracteres y contener al menos una letra mayúscula.');
                    return false; // Evita el envío del formulario
                }
        
                return true; // Permite el envío del formulario
            }
        
            function mostrarAlerta(alertId, mensaje) {
                var alert = document.getElementById(alertId);
                alert.innerHTML = mensaje;
                alert.style.display = 'block';
                setTimeout(function () {
                    alert.classList.add('fade-out');
                }, 1000);
                setTimeout(function () {
                    alert.style.display = 'none';
                    alert.classList.remove('fade-out');
                }, 2000);
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
            