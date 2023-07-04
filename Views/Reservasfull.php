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
    <link rel="stylesheet" href="css/reserva.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Reservas </title>
</head>
<body>
    
    <header class="bar-lat">
        <nav>
        <a href=" /Views/reservasusuario.php">  <i class='bx bx-arrow-back bx-lg  regre' ></i><li >regresar</li></a> 
        <a href=""> <i class='bx bx-user-circle bx-lg' ></i><li >Perfil</li></a>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <a href=""> <i class='bx bx-cog bx-lg  engrane' ></i><li >Soporte</li></a>
        </nav>
        <img src="img/logo 1.png"  class="block" alt=""> 
    </header>

<div class="borde">
  
    <?php

// Obtener el ID del usuario de la sesión
$idUsuario = $_SESSION['idUsuario'];



// Resive el id de usuarioreservas
if (isset($_GET['id'])) {
  $idPelicula = $_GET['id'];

  
  // Realizar la conexión a la base de datos y obtener los datos de la película seleccionada
  $host = "localhost";
  $user = "root";
  $password = "";
  $bd = "nixer";

  $conn = mysqli_connect($host, $user, $password, $bd);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}


  // Consulta para obtener los datos de la película seleccionada
  $sql = "SELECT * FROM cine WHERE id_cine_peli = '$idPelicula'";
  $result = mysqli_query($conn, $sql);


  // Verificar si se encontró la película
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Obtener los datos de la película
    $titulo = $row['titulo'];
    $imagen = $row['imagen'];
    $descripcion = $row['descripcion'];


    // Mostrar la pelicula y su informacion 
   echo '<div class="pelicula">';
   echo '<div class="pe">';
   //echo  '<img src="img/' . $imagen . '" alt=" ">'  ;
   echo '</div>';
   echo '<div class="despelicula">';
   echo '<h4>' . $titulo . '</h4>';
   echo '<p>' . $descripcion . '</p>';
   echo '</div>';
   echo '</div>';
  } else {
    echo 'No se encontró la película seleccionada.';
  }

  // Cerrar la conexión a la base de datos
  mysqli_close($conn);
} else {
  echo 'No se especificó ninguna película.';
}

//echo '<script>alert("ID de usuario: ' . $idUsuario . '");</script>';

?> 

      <img  class="img-cine" id="imagenMostrada" src="" alt="&nbsp ">

     <form action="" class="form-general">
       <section class="form-1">
        <div>

        <label for="">Seleccione cine</label>
        <select name="" id="" onchange="mostrarImagen(this.value)">
            <option value="none">&nbsp Ninguna &nbsp</option>
            <option value="cinemark.png">&nbsp Cine mark &nbsp</option>
            <option value="cinepolis.png">&nbsp Cinepolis &nbsp</option>
            <option value="cinecolombia.png">&nbsp cine colombia &nbsp </option>
        </select><br></div>
        <div>



        <label for="">Sede del Sede</label>
        
        <select name="" id="">
            <option value="">  Unisur </option>
            <option value="">  Mercurio</option>
            <option value=""> Plaza claro</option>
            <option value=""> Gran plaza </option>
        </select><br></div>

       </section><br>


         <section class="form-2">
            <div>
        <label for="">Seleccione sala</label><br>
        <select name="" id="">
            <option value="">Sala 1</option>
            <option value="">Sala 2</option>
            <option value="">Sala 3</option>
            <option value="">Sala 4</option>
            <option value="">Sala 5</option>
        </select><br>
            </div>
            <div>
        <label for="">Seleccione fila</label><br>
        <select name="" id="">
            <option value="">&nbsp &nbsp  &nbsp A&nbsp &nbsp &nbsp</option>
            <option value="">&nbsp &nbsp  &nbsp B&nbsp &nbsp &nbsp</option>
            <option value="">&nbsp &nbsp  &nbsp C&nbsp &nbsp &nbsp</option>
            <option value="">&nbsp &nbsp  &nbsp D&nbsp &nbsp &nbsp</option>
            <option value="">&nbsp &nbsp  &nbsp F&nbsp &nbsp &nbsp</option>
            <option value="">&nbsp &nbsp  &nbsp E&nbsp &nbsp &nbsp</option>
            <option value="">&nbsp &nbsp  &nbsp A1 &nbsp &nbsp &nbsp</option>
            <option value="">&nbsp &nbsp  &nbsp B1 &nbsp &nbsp &nbsp</option>
            <option value="">&nbsp &nbsp  &nbsp C1 &nbsp &nbsp &nbsp</option>
            <option value="">&nbsp &nbsp  &nbsp D1 &nbsp &nbsp &nbsp</option>
        </select><br>
            </div>
            <div>
        <label for="">Numero de asientos</label><br>
        <select name="" id="">
            <option value="">&nbsp &nbsp &nbsp 1 &nbsp &nbsp &nbsp</option>
        </select><br> 
            </div>
         </section>


         <section class="form-3">
            <div>
        <label for="">Seleccione asientos</label><br>
        <select name="" id="">
            <option value="">1</option>
            <option value="">2</option>
            <option value="">3</option>
            <option value="">4</option>
            <option value="">5</option>
            <option value="">6</option>
            <option value="">7</option>
            <option value="">8</option>
            <option value="">9</option>
            <option value="">10</option>
            <option value="">11</option>
            <option value="">12</option>
            <option value="">13</option>
            <option value="">14</option>
            <option value="">15</option>
            <option value="">16</option>
            <option value="">1-2-3</option>
            <option value="">10-11-12-13</option>
            <option value="">4-5-6</option>
            <option value="">14-15-16</option>
        </select><br>

            </div>


            <div>
        <label for="modal-select">Seleccione metodo de pago</label><br>
        <select name="" id="modal-select">
            <option value="modal1">&nbsp &nbsp Tarjeta &nbsp &nbsp </option>
            <option value="modal2">&nbsp &nbsp Pse &nbsp &nbsp</option>
        </select>
        <button type="button" class="btn-reserva" onclick="abrirModal()">Reservar</button>
            </div>

        </section>

    </div>

    </form>


     <form action="404.html">
    <div id="modal1" class="modal">
        <header class="modal-content1">
          <h2>TARJETA DE CREDITO O DEBITO</h2>
          <a onclick="cerrarModal()">X</a>
        </header>
          <div class="modal-content">
       
              <div class="pos-nom">
              <p><b> Nombre del titular</b></p>
              <input class="nom-titu" type="text" name="" id="myInput" onkeyup="validateInput(this)" placeholder="Como aparece en la tarjeta"required><br><br>
              </div>
              
              <div class="pos-num">
              <p><b>Numero de la tarjeta</b></p>
              <input class="nom-titu" type="number" name="" id="" placeholder="4208 3357XX XXXX"required><br><br>
              </div>
              
              <div class="pos-fe">
              <p><b>Fecha de expiracion</b></p>
              <input class="fecha-exp" type="number" name="" id="" placeholder="Mes"required>&nbsp &nbsp &nbsp <input class="fecha-exp" type="number" name="" id="" placeholder="Año"required><br><br>
              </div>

              <div class="pos-cod">
              <p><b>Codigo de seguridad</b></p>
              <input class="cod-seg" type="number" name="" id="" placeholder="CVV"required><br><br>
              </div>
              <h3>VALOR TOTAL DE TU RESERVA : $ 00.00</h3>

              <input type="submit" class="reserver" value="Reservar">
          </div>
      </div>
      
      
      <div id="modal2" class="modal">
        <header class="modal-content1">
          <h2>PAGO POR PSE</h2>
          <a onclick="cerrarModal()">X</i></a>
        </header>
          <div class="modal-content">
              <p></p>
          </div>
      </div>
     </form>

</body>
</html>


<script> 
    function abrirModal() {
       const select = document.getElementById("modal-select");
       const modalId = select.value;
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


<script>
    function mostrarImagen(imagen) {
      document.getElementById("imagenMostrada").src = imagen;
    }
  </script>


<script>
  function validateInput(input) {
  var regex = /^[a-zA-Z]+$/;
  var isValid = regex.test(input.value);
  if (!isValid) {
    input.value = input.value.replace(/[^a-zA-Z]+/g, '');
  }
}

</script>










<!---<label for="btn-modal" id="agre" class=""><i class="fa-solid fa-user-plus" ></i>Reservar</label>


<form action="" method="">
    <input type="checkbox" id="btn-modal">
      <div class="modal" >
        <div class="contenedor8" >
           <header>TARJETA DEBITO O CREDITO </header>
           <label for="btn-modal">X</label>
           <div class="contenido8">
              <h3>Nombre del titular</h3>
              <p><input type="text" name="cedulae"  style="border-radius: 3px" required=""></p>
              <h3>Numero de tarjeta </h3>
              <p><input type="text" name="nombree"  style="border-radius: 3px" required=""></p>
              <h3>Fecha de expiracion</h3>
              <p><input type="text" name="apellidoe"  style="border-radius: 3px" required=""></p>
              <h3>Codigo de seguridad</h3>
              <p><input type="text" name="cursoe"  style="border-radius: 3px" required=""></p>
             
              <p><input type="submit" value="Reservar" class="btn3 btn4"></p>
            </div>
        </div>
      </div>
    </form>