CREATE DATABASE IF NOT EXISTS plataforma_salud;
USE plataforma_salud;

DROP TABLE IF EXISTS documentos;
DROP TABLE IF EXISTS expedientes;
DROP TABLE IF EXISTS citas;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS roles;

CREATE TABLE roles (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL
);

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    contrasena VARCHAR(100) NOT NULL,
    id_rol INT NOT NULL,
    FOREIGN KEY (id_rol) REFERENCES roles(id_rol)
);

CREATE TABLE citas (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    estado VARCHAR(50) NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE expedientes (
    id_expediente INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    tipo_sangre VARCHAR(10) NOT NULL,
    diagnostico VARCHAR(255) NOT NULL,
    ultima_visita DATE NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

CREATE TABLE documentos (
    id_documento INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    fecha_documento DATE NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

INSERT INTO roles (nombre_rol) VALUES
('administrador'),
('paciente');

INSERT INTO usuarios (nombre, correo, contrasena, id_rol) VALUES
('Administrador General', 'admin@salud.com', '123', 1),
('Juan Perez', 'juan@salud.com', '123', 2);

INSERT INTO citas (id_usuario, especialidad, fecha, hora, estado) VALUES
(2, 'Medicina General', '2026-04-10', '09:00:00', 'Activa'),
(2, 'Cardiología', '2026-04-15', '11:30:00', 'Activa'),
(2, 'Dermatología', '2026-04-22', '14:00:00', 'Reprogramada');

INSERT INTO expedientes (id_usuario, tipo_sangre, diagnostico, ultima_visita) VALUES
(2, 'O+', 'Control general', '2026-03-20');

INSERT INTO documentos (id_usuario, titulo, descripcion, fecha_documento) VALUES
(2, 'Resultado de laboratorio', 'Hemograma completo disponible', '2026-03-18'),
(2, 'Receta médica', 'Tratamiento para control general', '2026-03-20');