--Esto debes poner en tu php Admin
--importas esta carpeta a myadminphp que automaticamente ya lo tienes por lo de git hub
CREATE DATABASE gamestore;
USE gamestore;

CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    rol ENUM('admin','cliente') DEFAULT 'cliente',
    codigo_2fa VARCHAR(10) DEFAULT NULL,
    estado_2fa TINYINT(1) DEFAULT 0,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);