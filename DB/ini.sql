CREATE DATABASE ecogrid_connect;
USE ecogrid_connect;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('consumidor','prosumidor','admin') NOT NULL,
    nombre VARCHAR(20) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    lat DECIMAL(9,6) NOT NULL,
    lng DECIMAL(9,6) NOT NULL,
    reputacion DECIMAL(2,1) DEFAULT 0
);

CREATE TABLE ofertas (
    id_oferta INT AUTO_INCREMENT PRIMARY KEY,
    id_prosumidor INT NOT NULL,
    kwh DECIMAL(6,2) NOT NULL CHECK (kwh > 0),
    precio DECIMAL(6,2) NOT NULL CHECK (precio > 0),
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    estado ENUM('disponible','vendida') DEFAULT 'disponible',
    FOREIGN KEY (id_prosumidor) REFERENCES usuarios(id_usuario)
);

CREATE TABLE transacciones (
    id_transaccion INT AUTO_INCREMENT PRIMARY KEY,
    id_oferta INT NOT NULL,
    id_consumidor INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(8,2),
    FOREIGN KEY (id_oferta) REFERENCES ofertas(id_oferta),
    FOREIGN KEY (id_consumidor) REFERENCES usuarios(id_usuario)
);

CREATE TABLE calificaciones (
    id_calificacion INT AUTO_INCREMENT PRIMARY KEY,
    id_transaccion INT NOT NULL,
    puntuacion INT CHECK (puntuacion BETWEEN 1 AND 5),
    comentario VARCHAR(20),
    FOREIGN KEY (id_transaccion) REFERENCES transacciones(id_transaccion)
);
-- demo
INSERT INTO usuarios (nombre, tipo)
VALUES ('Prosumidor Demo', 'PROSUMIDOR');
-- demo
INSERT INTO usuarios (nombre, tipo, email)
VALUES ('Consumidor Demo', 'CONSUMIDOR', 'juan@juan.com');