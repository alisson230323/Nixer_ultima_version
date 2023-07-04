<?php
session_start();

// Verificar si no hay una sesión activa
if (!isset($_SESSION['rol'])) {
    echo "<script>alert('(ACCESSO DENEGADO) Inicie sesión o registrese POR FAVOR'); window.location.href = '/Views/index.php';</script>";
    exit();
}
?>






