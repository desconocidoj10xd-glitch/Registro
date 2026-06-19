<?php
// Inicia la sesión en todas las páginas que incluyan este archivo
session_start();

// --- Datos de conexión a MySQL (XAMPP por defecto) ---
$host_bd     = "localhost";
$usuario_bd  = "root";
$contrasena_bd = "";
$nombre_bd   = "sistema_citas";

$conexion = mysqli_connect($host_bd, $usuario_bd, $contrasena_bd, $nombre_bd);

if (!$conexion) {
    die("Error de conexión a la base de datos: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8mb4");
?>
