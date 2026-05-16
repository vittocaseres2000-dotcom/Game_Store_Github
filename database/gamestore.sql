CREATE DATABASE gamestore;
USE gamestore;

-- =========================================
-- TABLA USUARIO
-- =========================================
CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'cliente') DEFAULT 'cliente',
    codigo_2fa VARCHAR(10),
    estado_2fa BOOLEAN DEFAULT FALSE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================
-- TABLA CATEGORIA
-- =========================================
CREATE TABLE categoria (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(100) NOT NULL,
    descripcion TEXT
);

-- =========================================
-- TABLA PRODUCTO
-- =========================================
CREATE TABLE producto (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    marca VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    imagen VARCHAR(255),
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',

    CONSTRAINT fk_producto_categoria
    FOREIGN KEY (id_categoria)
    REFERENCES categoria(id_categoria)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

-- =========================================
-- TABLA VENTA
-- =========================================
CREATE TABLE venta (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2) NOT NULL,
    estado_venta ENUM('pendiente', 'pagado', 'entregado')
    DEFAULT 'pendiente',

    CONSTRAINT fk_venta_usuario
    FOREIGN KEY (id_usuario)
    REFERENCES usuario(id_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

-- =========================================
-- TABLA DETALLE_VENTA
-- =========================================
CREATE TABLE detalle_venta (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,

    CONSTRAINT fk_detalle_venta
    FOREIGN KEY (id_venta)
    REFERENCES venta(id_venta)
    ON DELETE CASCADE
    ON UPDATE CASCADE,

    CONSTRAINT fk_detalle_producto
    FOREIGN KEY (id_producto)
    REFERENCES producto(id_producto)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

-- =========================================
-- TABLA FAVORITO
-- =========================================
CREATE TABLE favorito (
    id_favorito INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_producto INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_favorito_usuario
    FOREIGN KEY (id_usuario)
    REFERENCES usuario(id_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE,

    CONSTRAINT fk_favorito_producto
    FOREIGN KEY (id_producto)
    REFERENCES producto(id_producto)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

-- =========================================
-- INSERTAR CATEGORIAS
-- =========================================
INSERT INTO categoria (nombre_categoria, descripcion) VALUES
('Laptops Gamer', 'Equipos gamer de alto rendimiento'),
('Monitores', 'Monitores gaming y profesionales'),
('Mouse', 'Mouse gamer RGB'),
('Teclados', 'Teclados mecanicos gamer'),
('Consolas', 'Consolas de videojuegos');

-- =========================================
-- INSERTAR USUARIO ADMIN
-- contraseña: admin123
-- =========================================
INSERT INTO usuario (
    nombre,
    correo,
    contrasena,
    rol,
    estado_2fa
) VALUES (
    'Administrador',
    'admin@gamestore.com',
    '$2y$10$Q9xw0Jf6uD9WfD9mR2V8eOv9xH3L9XnA6mFj5K8Q1nCzR0H9A3Y8K',
    'admin',
    TRUE
);

-- =========================================
-- INSERTAR PRODUCTOS
-- =========================================
INSERT INTO producto (
    id_categoria,
    nombre,
    marca,
    descripcion,
    precio,
    stock,
    imagen
) VALUES
(1, 'Laptop ASUS ROG', 'ASUS',
'Laptop gamer RTX 4060', 1500.00, 10, 'rog.jpg'),

(2, 'Monitor Samsung 27"', 'Samsung',
'Monitor gamer 144Hz', 350.00, 15, 'monitor.jpg'),

(3, 'Mouse Logitech G502', 'Logitech',
'Mouse RGB gamer', 80.00, 20, 'mouse.jpg'),

(4, 'Teclado Redragon K552', 'Redragon',
'Teclado mecanico RGB', 70.00, 12, 'teclado.jpg'),

(5, 'PlayStation 5', 'Sony',
'Consola de videojuegos PS5', 700.00, 5, 'ps5.jpg');

-- =========================================
-- INSERTAR VENTA DE EJEMPLO
-- =========================================
INSERT INTO venta (
    id_usuario,
    total,
    estado_venta
) VALUES (
    1,
    1580.00,
    'pagado'
);

-- =========================================
-- INSERTAR DETALLE DE VENTA
-- =========================================
INSERT INTO detalle_venta (
    id_venta,
    id_producto,
    cantidad,
    subtotal
) VALUES
(1, 1, 1, 1500.00),
(1, 3, 1, 80.00);

-- =========================================
-- INSERTAR FAVORITOS
-- =========================================
INSERT INTO favorito (
    id_usuario,
    id_producto
) VALUES
(1, 5),
(1, 3);