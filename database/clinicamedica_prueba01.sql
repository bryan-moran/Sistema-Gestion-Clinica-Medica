-- =============================================
-- BASE DE DATOS: clinicamedica_prueba01
-- =============================================

CREATE DATABASE IF NOT EXISTS clinicamedica_prueba01;
USE clinicamedica_prueba01;

-- =============================================
-- TABLA: usuarios
-- =============================================
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(30) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM('Administrador', 'Secretaria', 'Médico General', 'Médico Pediatra') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================================
-- TABLA: pacientes
-- =============================================
CREATE TABLE IF NOT EXISTS pacientes (
    dui VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    telefono VARCHAR(15) DEFAULT NULL,
    edad INT DEFAULT NULL,
    fecha_nacimiento DATE DEFAULT NULL,
    direccion TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================================
-- TABLA: medicos
-- =============================================
CREATE TABLE IF NOT EXISTS medicos (
    dui VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    especialidad VARCHAR(50) DEFAULT NULL,
    telefono VARCHAR(15) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================================
-- TABLA: citas
-- =============================================
CREATE TABLE IF NOT EXISTS citas (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    dui_paciente VARCHAR(10) NOT NULL,
    dui_medico VARCHAR(10) NOT NULL,
    tipo_cita ENUM('consulta', 'control', 'urgencia', 'pediatria', 'general') DEFAULT 'consulta',
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    motivo TEXT NOT NULL,
    estado ENUM('programada', 'confirmada', 'pendiente', 'completada', 'cancelada') DEFAULT 'programada',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (dui_paciente) REFERENCES pacientes(dui) ON DELETE CASCADE,
    FOREIGN KEY (dui_medico) REFERENCES medicos(dui) ON DELETE CASCADE
);

-- =============================================
-- DATOS: Usuarios (contraseñas en texto plano)
-- =============================================
INSERT INTO usuarios (usuario, contrasena, rol) VALUES
('admin',           'Admin@2024!',  'Administrador'),
('secretaria',      'Secre@2024!',  'Secretaria'),
('medico_general',  'MedGen@2024!', 'Médico General'),
('medico_pediatra', 'MedPed@2024!', 'Médico Pediatra');

-- =============================================
-- DATOS: Pacientes
-- =============================================
INSERT INTO pacientes (dui, nombre, apellido, telefono, edad, fecha_nacimiento, direccion) VALUES
('12345678-9', 'Ana María',      'Rodríguez', '6123-4567', 34, '1990-05-15', 'Calle Los Pinos #123, Colonia Centro'),
('98765432-1', 'Carlos Eduardo', 'Méndez',    '6789-0123', 45, '1979-08-22', 'Avenida Reforma #456, Zona 10'),
('55555555-5', 'María Fernanda', 'López',     '6345-7890', 28, '1996-03-10', 'Boulevard Los Próceres #789'),
('44444444-4', 'José Antonio',   'Ramírez',   '6567-8901', 52, '1972-11-30', 'Colonia Escalón #321'),
('33333333-3', 'Laura Patricia', 'Gómez',     '6890-1234', 31, '1993-07-18', 'Residencial San Luis #45'),
('22222222-2', 'Roberto Carlos', 'Flores',    '6700-1122', 38, '1986-09-25', 'Paseo General Escalón #567'),
('11111111-1', 'Martha Elena',   'Sánchez',   '6987-6543', 29, '1995-12-03', 'Colonia Médica #12');

-- =============================================
-- DATOS: Médicos (solo 2)
-- =============================================
INSERT INTO medicos (dui, nombre, apellido, especialidad, telefono) VALUES
('00112233-4', 'Juan Carlos', 'Martínez', 'Medicina General', '7012-3456'),
('00223344-5', 'Laura Elena',  'García',   'Pediatría',        '7023-4567');

-- =============================================
-- DATOS: Citas
-- =============================================

-- Hoy
INSERT INTO citas (dui_paciente, dui_medico, tipo_cita, fecha, hora, motivo, estado) VALUES
('12345678-9', '00112233-4', 'consulta',  CURDATE(), '09:00:00', 'Dolor de cabeza persistente',     'confirmada'),
('98765432-1', '00112233-4', 'control',   CURDATE(), '10:30:00', 'Control de diabetes y presión',   'programada'),
('55555555-5', '00223344-5', 'pediatria', CURDATE(), '11:00:00', 'Control de crecimiento infantil', 'confirmada'),
('44444444-4', '00112233-4', 'urgencia',  CURDATE(), '14:30:00', 'Dolor en el pecho',               'pendiente');

-- Mañana
INSERT INTO citas (dui_paciente, dui_medico, tipo_cita, fecha, hora, motivo, estado) VALUES
('33333333-3', '00223344-5', 'consulta', DATE_ADD(CURDATE(), INTERVAL 1 DAY), '09:30:00', 'Revisión pediátrica anual', 'programada'),
('22222222-2', '00112233-4', 'control',  DATE_ADD(CURDATE(), INTERVAL 1 DAY), '11:15:00', 'Chequeo general',           'programada'),
('11111111-1', '00223344-5', 'consulta', DATE_ADD(CURDATE(), INTERVAL 1 DAY), '15:00:00', 'Control de crecimiento',    'confirmada');

-- Esta semana
INSERT INTO citas (dui_paciente, dui_medico, tipo_cita, fecha, hora, motivo, estado) VALUES
('12345678-9', '00112233-4', 'consulta',  DATE_ADD(CURDATE(), INTERVAL 3 DAY), '08:45:00', 'Chequeo general',           'programada'),
('98765432-1', '00112233-4', 'control',   DATE_ADD(CURDATE(), INTERVAL 4 DAY), '13:30:00', 'Resultados de laboratorio', 'programada'),
('55555555-5', '00223344-5', 'pediatria', DATE_ADD(CURDATE(), INTERVAL 5 DAY), '10:00:00', 'Vacunas de rutina',         'pendiente'),
('44444444-4', '00223344-5', 'consulta',  DATE_ADD(CURDATE(), INTERVAL 6 DAY), '16:20:00', 'Seguimiento pediátrico',    'confirmada');

-- Pasadas (completadas)
INSERT INTO citas (dui_paciente, dui_medico, tipo_cita, fecha, hora, motivo, estado) VALUES
('33333333-3', '00112233-4', 'consulta', DATE_SUB(CURDATE(), INTERVAL 10 DAY), '10:00:00', 'Gripe y fiebre',    'completada'),
('22222222-2', '00223344-5', 'control',  DATE_SUB(CURDATE(), INTERVAL 15 DAY), '11:30:00', 'Control pediátrico','completada'),
('11111111-1', '00112233-4', 'consulta', DATE_SUB(CURDATE(), INTERVAL 20 DAY), '09:15:00', 'Mareos frecuentes', 'completada');
