<?php
require_once 'config.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - Sistema de Citas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="barra-superior">
        <div class="marca">
            <h1>Sistema de Citas</h1>
            <span>Panel principal</span>
        </div>
        <nav>
            <span>Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
            <a href="logout.php" class="salir">Cerrar sesión</a>
        </nav>
    </div>

    <div class="contenido">
        <h2 style="font-size: 22px; color: var(--azul-tinta);">¿Qué deseas hacer?</h2>

        <div class="rejilla-menu">
            <a href="registro_clientes.php" class="tarjeta-folder" data-folio="EXP. 01">
                <h2>Registro de clientes</h2>
                <p>Da de alta un nuevo cliente con su nombre completo, CURP, teléfono y correo electrónico.</p>
            </a>

            <a href="agenda_citas.php" class="tarjeta-folder" data-folio="EXP. 02">
                <h2>Agenda de citas</h2>
                <p>Programa una nueva cita indicando fecha, hora y el tipo de trámite a realizar.</p>
            </a>
        </div>
    </div>

</body>
</html>
