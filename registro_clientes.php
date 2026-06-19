<?php
require_once 'config.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$mensaje = "";
$tipo_mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_completo = trim($_POST['nombre_completo']);
    $curp            = trim(strtoupper($_POST['curp']));
    $telefono        = trim($_POST['telefono']);
    $correo          = trim($_POST['correo']);

    $sql = "INSERT INTO clientes (nombre_completo, curp, telefono, correo) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $nombre_completo, $curp, $telefono, $correo);

    if (mysqli_stmt_execute($stmt)) {
        $mensaje = "Cliente registrado correctamente.";
        $tipo_mensaje = "exito";
    } else {
        if (mysqli_errno($conexion) == 1062) {
            $mensaje = "Ya existe un cliente registrado con esa CURP.";
        } else {
            $mensaje = "Ocurrió un error al guardar: " . mysqli_error($conexion);
        }
        $tipo_mensaje = "error";
    }
}

// Obtenemos la lista de clientes para mostrarla debajo del formulario
$clientes = mysqli_query($conexion, "SELECT * FROM clientes ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de clientes - Sistema de Citas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="barra-superior">
        <div class="marca">
            <h1>Sistema de Citas</h1>
            <span>Registro de clientes</span>
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
                <h2>Nuevo cliente</h2>
                <span class="folio">Exp. 01</span>
            </div>

            <?php if ($mensaje): ?>
                <div class="mensaje mensaje-<?php echo $tipo_mensaje; ?>">
                    <?php echo htmlspecialchars($mensaje); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="registro_clientes.php">
                <div class="fila-campos">
                    <div class="campo">
                        <label for="nombre_completo">Nombre completo</label>
                        <input type="text" id="nombre_completo" name="nombre_completo" required>
                    </div>
                    <div class="campo">
                        <label for="curp">CURP</label>
                        <input type="text" id="curp" name="curp" maxlength="18" minlength="18" required>
                    </div>
                </div>
                <div class="fila-campos">
                    <div class="campo">
                        <label for="telefono">Teléfono</label>
                        <input type="tel" id="telefono" name="telefono" required>
                    </div>
                    <div class="campo">
                        <label for="correo">Correo electrónico</label>
                        <input type="email" id="correo" name="correo" required>
                    </div>
                </div>
                <button type="submit" class="boton boton-dorado">Registrar cliente</button>
            </form>
        </div>

        <div class="panel">
            <div class="panel-encabezado">
                <h2>Clientes registrados</h2>
            </div>

            <?php if (mysqli_num_rows($clientes) > 0): ?>
                <table class="tabla-registros">
                    <thead>
                        <tr>
                            <th>Nombre completo</th>
                            <th>CURP</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($cliente = mysqli_fetch_assoc($clientes)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($cliente['nombre_completo']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['curp']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['telefono']); ?></td>
                                <td><?php echo htmlspecialchars($cliente['correo']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="vacio">Todavía no hay clientes registrados.</p>
            <?php endif; ?>
        </div>

        <a href="menu.php" class="enlace-volver">&larr; Volver al menú</a>
    </div>

</body>
</html>
