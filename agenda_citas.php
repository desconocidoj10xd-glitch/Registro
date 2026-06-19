<?php
require_once 'config.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$mensaje = "";
$tipo_mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha        = $_POST['fecha'];
    $hora         = $_POST['hora'];
    $tipo_tramite = trim($_POST['tipo_tramite']);

    $sql = "INSERT INTO citas (fecha, hora, tipo_tramite) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $fecha, $hora, $tipo_tramite);

    if (mysqli_stmt_execute($stmt)) {
        $mensaje = "Cita agendada correctamente.";
        $tipo_mensaje = "exito";
    } else {
        $mensaje = "Ocurrió un error al guardar: " . mysqli_error($conexion);
        $tipo_mensaje = "error";
    }
}

// Obtenemos la lista de citas ordenadas por fecha y hora 
$citas = mysqli_query($conexion, "SELECT * FROM citas ORDER BY fecha ASC, hora ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de citas - Sistema de Citas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="barra-superior">
        <div class="marca">
            <h1>Sistema de Citas</h1>
            <span>Agenda de citas</span>
        </div>
        <nav>
            <a href="menu.php">Menú</a>
            <span>Hola, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
            <a href="logout.php" class="salir">Cerrar sesión</a>
        </nav>
    </div>

    <div class="contenido">

        <div class="panel">
            <div class="panel-encabezado">
                <h2>Agendar nueva cita</h2>
                <span class="folio">Exp. 02</span>
            </div>

            <?php if ($mensaje): ?>
                <div class="mensaje mensaje-<?php echo $tipo_mensaje; ?>">
                    <?php echo htmlspecialchars($mensaje); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="agenda_citas.php">
                <div class="fila-campos">
                    <div class="campo">
                        <label for="fecha">Fecha</label>
                        <input type="date" id="fecha" name="fecha" required>
                    </div>
                    <div class="campo">
                        <label for="hora">Hora</label>
                        <input type="time" id="hora" name="hora" required>
                    </div>
                </div>
                <div class="campo">
                    <label for="tipo_tramite">Tipo de trámite</label>
                    <input type="text" id="tipo_tramite" name="tipo_tramite" placeholder="Ej. Renovación de licencia" required>
                </div>
                <button type="submit" class="boton boton-dorado">Agendar cita</button>
            </form>
        </div>

        <div class="panel">
            <div class="panel-encabezado">
                <h2>Citas agendadas</h2>
            </div>

            <?php if (mysqli_num_rows($citas) > 0): ?>
                <table class="tabla-registros">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Tipo de trámite</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($cita = mysqli_fetch_assoc($citas)): ?>
                            <tr>
                                <td><?php echo date("d/m/Y", strtotime($cita['fecha'])); ?></td>
                                <td><?php echo date("h:i A", strtotime($cita['hora'])); ?></td>
                                <td><?php echo htmlspecialchars($cita['tipo_tramite']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="vacio">Todavía no hay citas agendadas.</p>
            <?php endif; ?>
        </div>

        <a href="menu.php" class="enlace-volver">&larr; Volver al menú</a>
    </div>

</body>
</html>
