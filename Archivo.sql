-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS sistema_tesis;
USE sistema_tesis;

-- Tabla de roles de usuario
CREATE TABLE roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL
);

-- Insertar roles predeterminados
INSERT INTO roles (nombre) VALUES 
('Estudiante'),
('Docente');

-- Tabla de usuarios
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  rol_id INT NOT NULL,
  FOREIGN KEY (rol_id) REFERENCES roles(id)
);

SELECT * FROM tesis;

-- Tabla de estados de tesis
CREATE TABLE estados (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre_estado VARCHAR(100) NOT NULL
);

-- Insertar estados predeterminados
INSERT INTO estados (nombre_estado) VALUES
('Propuesta'),
('Revisión'),
('Corrección de observaciones'),
('Aprobada'),
('Presentación final');

-- Tabla de tesis
CREATE TABLE tesis (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(200) NOT NULL,
  Descripcion TEXT NOT NULL,
  etapa INT NOT NULL,
  colaboradores VARCHAR(200) NULL,
  fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  estado_id INT,
  FOREIGN KEY (estado_id) REFERENCES estados(id)
);

-- Ahora, después de crear la tabla tesis, crea la tabla tesis_usuarios
CREATE TABLE tesis_usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tesis_id INT,
  usuario_id INT,
  tipo_participacion ENUM('Autor', 'Director') NOT NULL,
  FOREIGN KEY (tesis_id) REFERENCES tesis(id) ON DELETE CASCADE,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabla para registrar el historial de avance por tesis
CREATE TABLE historial_avance (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tesis_id INT,
  estado_id INT,
  fecha_cambio DATETIME DEFAULT CURRENT_TIMESTAMP,
  observaciones TEXT,
  FOREIGN KEY (tesis_id) REFERENCES tesis(id),
  FOREIGN KEY (estado_id) REFERENCES estados(id)
);

CREATE TABLE archivos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tesis_id INT,
  nombre_archivo VARCHAR(255),
  tipo_archivo VARCHAR(50),
  ruta_archivo VARCHAR(255),
  fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (tesis_id) REFERENCES tesis(id) ON DELETE CASCADE
);






