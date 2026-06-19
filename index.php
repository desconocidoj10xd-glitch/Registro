<?php
require_once 'config.php';

// Si ya inició sesión, lo mandamos directo al menú
if (isset($_SESSION['usuario'])) {
    header("Location: menu.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario    = trim($_POST['usuario']);
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $fila = mysqli_fetch_assoc($resultado);

    if ($fila && password_verify($contrasena, $fila['contrasena'])) {
        $_SESSION['usuario']    = $fila['usuario'];
        $_SESSION['id_usuario'] = $fila['id'];
        header("Location: menu.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Sistema de Citas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="pantalla-login">
        <div class="tarjeta-login">
            <span class="eyebrow">Acceso al sistema</span>
            <h1>Inicio de sesión</h1>

            <?php if ($error): ?>
                <div class="mensaje mensaje-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" action="index.php">
                <div class="campo">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" required autofocus>
                </div>
                <div class="campo">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" id="contrasena" name="contrasena" required>
                </div>
                <button type="submit" class="boton">Iniciar sesión</button>
            </form>
        </div>
    </div>

</body>
</html>
