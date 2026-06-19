SISTEMA DE CITAS — Instrucciones de instalación
=================================================

QUÉ INCLUYE
------------
- index.php            -> Pantalla de inicio de sesión
- menu.php              -> Menú principal (después de iniciar sesión)
- registro_clientes.php -> Alta de clientes (nombre, CURP, teléfono, correo)
- agenda_citas.php      -> Agenda de citas (fecha, hora, tipo de trámite)
- logout.php            -> Cerrar sesión
- config.php            -> Conexión a la base de datos
- css/style.css         -> Estilos de todas las páginas
- sql/sistema_citas.sql -> Script para crear la base de datos y las tablas

PASO 1: Copiar el proyecto a XAMPP
------------------------------------
Copia toda la carpeta "sistema_citas" dentro de:

    C:\xampp\htdocs\

Quedando así: C:\xampp\htdocs\sistema_citas\

PASO 2: Crear la base de datos
---------------------------------
1. Abre el Panel de Control de XAMPP y enciende "Apache" y "MySQL".
2. Abre tu navegador y entra a: http://localhost/phpmyadmin
3. Ve a la pestaña "Importar" (Import).
4. Selecciona el archivo: sistema_citas/sql/sistema_citas.sql
5. Da clic en "Continuar" / "Importar".

Esto crea la base de datos "sistema_citas" con sus 3 tablas (usuarios,
clientes, citas) y además crea un usuario administrador para que puedas
entrar al sistema:

    Usuario:    admin
    Contraseña: admin123

PASO 3: Abrir el proyecto en VS Code
----------------------------------------
1. Abre VS Code.
2. Archivo > Abrir carpeta... y selecciona C:\xampp\htdocs\sistema_citas
3. (Opcional) Instala la extensión "PHP Intelephense" para autocompletado.

PASO 4: Probar la página
----------------------------
Con Apache y MySQL encendidos en XAMPP, abre tu navegador en:

    http://localhost/sistema_citas/

Inicia sesión con admin / admin123 y ya puedes registrar clientes y
agendar citas.

CÓMO AGREGAR MÁS USUARIOS DE LOGIN
--------------------------------------
Por seguridad, las contraseñas se guardan encriptadas (hash), no en texto
plano. Para crear un usuario nuevo desde phpMyAdmin necesitas el hash de
la contraseña, no la contraseña directa. Si quieres agregar otro usuario
(por ejemplo "recepcion"), dime qué contraseña quieres usar y te genero el
hash exacto para que lo insertes en la tabla "usuarios".

NOTAS
------
- Los campos con * (required) no dejan enviar el formulario si están vacíos.
- La CURP se guarda en mayúsculas automáticamente y no permite duplicados.
- Si ves "Error de conexión a la base de datos", revisa que MySQL esté
  encendido en XAMPP y que el nombre de la base (sistema_citas) coincida
  con el de config.php.
