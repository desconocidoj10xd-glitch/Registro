-- aqui se entra al admin de xampp y se ejecuta este script para crear la base de datos y las tablas necesarias para el sistema de citas o solo importarlo en el apartado de mysql de xampp, se recomienda cambiar la contraseña del usuario admin despues de la primera vez que se ingrese al sistema, para eso se puede usar el siguiente comando:

CREATE DATABASE IF NOT EXISTS sistema_citas
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_spanish_ci;

USE sistema_citas;

-- Tabla de usuarios (login del sistema)
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(50) NOT NULL UNIQUE,
  contrasena VARCHAR(255) NOT NULL,
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de clientes no borrar porfavor
CREATE TABLE clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre_completo VARCHAR(150) NOT NULL,
  curp VARCHAR(18) NOT NULL UNIQUE,
  telefono VARCHAR(15) NOT NULL,
  correo VARCHAR(100) NOT NULL,
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de citas (agenda) tampoco borrar
CREATE TABLE citas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fecha DATE NOT NULL,
  hora TIME NOT NULL,
  tipo_tramite VARCHAR(150) NOT NULL,
  creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Usuario administrador inicial
-- Usuario:    admin
-- Contraseña: admin123   (cámbiala después de tu primer login) cambiala y que nadie la sepa solo el admin
INSERT INTO usuarios (usuario, contrasena) VALUES
('admin', '$2y$10$RwuwyZStPiULJAY.J/FCHewntFuuL5lBC1Bp5FS9VbGJl8bjPu7nW');
