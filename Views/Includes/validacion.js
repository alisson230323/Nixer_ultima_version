function validateForm() {
    var nombreUsuario = document.forms["myForm"]["nombre_usuario"].value;
    var salaNombre = document.forms["myForm"]["nombre"].value;
    var descripcion = document.forms["myForm"]["descripcion"].value;

    if (nombreUsuario == "" || salaNombre == "" || descripcion == "") {
        alert("Por favor, rellena todos los campos");
        return false;
    }
}