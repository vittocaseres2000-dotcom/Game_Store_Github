CREATE DATABASE IF NOT EXISTS gamestore;

USE gamestore;

-- =========================
-- TABLA USUARIO
-- =========================

CREATE TABLE usuario (

    id_usuario INT AUTO_INCREMENT PRIMARY KEY,

    nombre VARCHAR(100) NOT NULL,

    correo VARCHAR(100) NOT NULL UNIQUE,

    contrasena VARCHAR(255) NOT NULL,

    rol ENUM('admin','cliente') DEFAULT 'cliente',

    codigo_2fa VARCHAR(10) DEFAULT NULL,

    estado_2fa TINYINT(1) DEFAULT 0,

    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

-- =========================
-- TABLA CATEGORIA
-- =========================

CREATE TABLE categoria (

    id_categoria INT AUTO_INCREMENT PRIMARY KEY,

    nombre_categoria VARCHAR(100) NOT NULL,

    descripcion TEXT

);

-- =========================
-- TABLA PRODUCTO
-- =========================

CREATE TABLE producto (

    id_producto INT AUTO_INCREMENT PRIMARY KEY,

    id_categoria INT NOT NULL,

    nombre VARCHAR(150) NOT NULL,

    marca VARCHAR(100),

    descripcion TEXT,

    precio DECIMAL(10,2) NOT NULL,

    stock INT DEFAULT 0,

    imagen VARCHAR(255),

    estado ENUM('activo','inactivo') DEFAULT 'activo',

    FOREIGN KEY (id_categoria)
    REFERENCES categoria(id_categoria)

);

-- =========================
-- TABLA VENTA
-- =========================

CREATE TABLE venta (

    id_venta INT AUTO_INCREMENT PRIMARY KEY,

    id_usuario INT NOT NULL,

    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    total DECIMAL(10,2) NOT NULL,

    estado_venta ENUM(
        'pendiente',
        'pagado',
        'entregado'
    ) DEFAULT 'pendiente',

    FOREIGN KEY (id_usuario)
    REFERENCES usuario(id_usuario)

);

-- =========================
-- TABLA DETALLE_VENTA
-- =========================

CREATE TABLE detalle_venta (

    id_detalle INT AUTO_INCREMENT PRIMARY KEY,

    id_venta INT NOT NULL,

    id_producto INT NOT NULL,

    cantidad INT NOT NULL,

    subtotal DECIMAL(10,2) NOT NULL,

    FOREIGN KEY (id_venta)
    REFERENCES venta(id_venta),

    FOREIGN KEY (id_producto)
    REFERENCES producto(id_producto)

);

-- =========================
-- TABLA FAVORITO
-- =========================

CREATE TABLE favorito (

    id_favorito INT AUTO_INCREMENT PRIMARY KEY,

    id_usuario INT NOT NULL,

    id_producto INT NOT NULL,

    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_usuario)
    REFERENCES usuario(id_usuario),

    FOREIGN KEY (id_producto)
    REFERENCES producto(id_producto)

);