CREATE DATABASE IF NOT EXISTS clinicamedica_stm
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE clinicamedica_stm;

-- ============================================================
-- USUARIOS
-- ============================================================

CREATE TABLE usuarios (
    id INT NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(30) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol ENUM(
        'Administrador',
        'Secretaria',
        'Médico General',
        'Médico Pediatra'
    ) NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY usuario (usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- MEDICOS
-- ============================================================

CREATE TABLE medicos (
    dui VARCHAR(10) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    especialidad VARCHAR(50) DEFAULT NULL,
    telefono VARCHAR(15) DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (dui)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- PACIENTES
-- ============================================================

CREATE TABLE pacientes (
    dui VARCHAR(10) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    telefono VARCHAR(15) DEFAULT NULL,
    edad INT DEFAULT NULL,
    fecha_nacimiento DATE DEFAULT NULL,
    direccion TEXT,
    alergias TEXT DEFAULT NULL,
    anotaciones TEXT DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (dui)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- CITAS
-- ============================================================

CREATE TABLE citas (
    id_cita INT NOT NULL AUTO_INCREMENT,
    dui_paciente VARCHAR(10) NOT NULL,
    dui_medico VARCHAR(10) NOT NULL,
    tipo_cita ENUM(
        'consulta',
        'control',
        'urgencia',
        'pediatria',
        'general'
    ) DEFAULT 'consulta',
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    motivo TEXT NOT NULL,
    estado ENUM(
        'programada',
        'confirmada',
        'pendiente',
        'completada',
        'cancelada'
    ) DEFAULT 'programada',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_cita),

    KEY fk_cita_paciente (dui_paciente),
    KEY fk_cita_medico (dui_medico),

    CONSTRAINT fk_cita_paciente
        FOREIGN KEY (dui_paciente)
        REFERENCES pacientes (dui)
        ON DELETE CASCADE,

    CONSTRAINT fk_cita_medico
        FOREIGN KEY (dui_medico)
        REFERENCES medicos (dui)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- CONSULTAS
-- ============================================================

CREATE TABLE consultas (
    id_consulta INT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_cita INT NOT NULL,
    dui_paciente VARCHAR(10) NOT NULL,
    dui_medico VARCHAR(10) NOT NULL,
    diagnostico TEXT,
    notas TEXT,
    tratamiento TEXT,
    fecha_consulta DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id_consulta),

    UNIQUE KEY uq_cita (id_cita),

    KEY dui_paciente (dui_paciente),
    KEY dui_medico (dui_medico),

    CONSTRAINT consultas_ibfk_1
        FOREIGN KEY (dui_paciente)
        REFERENCES pacientes (dui),

    CONSTRAINT consultas_ibfk_2
        FOREIGN KEY (dui_medico)
        REFERENCES medicos (dui)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- EMERGENCIAS
-- ============================================================

CREATE TABLE emergencias (
    id_emergencia INT UNSIGNED NOT NULL AUTO_INCREMENT,
    dui_paciente VARCHAR(10) NOT NULL,
    dui_medico VARCHAR(10) NOT NULL,
    motivo TEXT NOT NULL,

    nivel_urgencia ENUM(
        'alta',
        'media',
        'baja'
    ) NOT NULL DEFAULT 'alta',

    estado ENUM(
        'pendiente',
        'atendida',
        'cancelada'
    ) NOT NULL DEFAULT 'pendiente',

    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id_emergencia),

    KEY fk_emerg_paciente (dui_paciente),
    KEY fk_emerg_medico (dui_medico),

    CONSTRAINT fk_emerg_paciente
        FOREIGN KEY (dui_paciente)
        REFERENCES pacientes (dui)
        ON DELETE CASCADE,

    CONSTRAINT fk_emerg_medico
        FOREIGN KEY (dui_medico)
        REFERENCES medicos (dui)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE medicamentos (
    id_medicamento INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    presentacion VARCHAR(100) DEFAULT NULL,
    concentracion VARCHAR(100) DEFAULT NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id_medicamento)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE recetas (
    id_receta INT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_cita INT NOT NULL,
    id_medicamento INT UNSIGNED NOT NULL,

    dosis VARCHAR(100) DEFAULT NULL,
    frecuencia VARCHAR(100) DEFAULT NULL,
    duracion VARCHAR(100) DEFAULT NULL,
    instrucciones TEXT DEFAULT NULL,

    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id_receta),

    KEY fk_receta_cita (id_cita),
    KEY fk_receta_medicamento (id_medicamento),

    CONSTRAINT fk_receta_cita
        FOREIGN KEY (id_cita)
        REFERENCES citas(id_cita)
        ON DELETE CASCADE,

    CONSTRAINT fk_receta_medicamento
        FOREIGN KEY (id_medicamento)
        REFERENCES medicamentos(id_medicamento)
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO medicamentos
(nombre,presentacion,concentracion,activo)
VALUES
('Ibuprofeno','Tabletas','400mg',1),
('Ibuprofeno','Tabletas','600mg',1),
('Ibuprofeno','Suspensión','100mg/5ml',1),
('Paracetamol','Tabletas','500mg',1),
('Paracetamol','Jarabe','120mg/5ml',1),
('Naproxeno','Tabletas','500mg',1),
('Diclofenaco','Tabletas','50mg',1),
('Diclofenaco','Gel','1%',1),
('Ketorolaco','Tabletas','10mg',1),
('Metamizol','Tabletas','500mg',1),
('Amoxicilina','Cápsulas','500mg',1),
('Amoxicilina','Suspensión','250mg/5ml',1),
('Amoxicilina/Clavulanato','Tabletas','875mg/125mg',1),
('Azitromicina','Tabletas','500mg',1),
('Ciprofloxacino','Tabletas','500mg',1),
('Claritromicina','Tabletas','500mg',1),
('Cefalexina','Cápsulas','500mg',1),
('Metronidazol','Tabletas','500mg',1),
('Trimetoprim/Sulfa','Tabletas','160mg/800mg',1),
('Doxiciclina','Cápsulas','100mg',1),
('Omeprazol','Cápsulas','20mg',1),
('Omeprazol','Cápsulas','40mg',1),
('Ranitidina','Tabletas','150mg',1),
('Metoclopramida','Tabletas','10mg',1),
('Loperamida','Cápsulas','2mg',1),
('Sales de Rehidratación','Polvo','27.9g/sobre',1),
('Losartán','Tabletas','50mg',1),
('Losartán','Tabletas','100mg',1),
('Enalapril','Tabletas','10mg',1),
('Amlodipino','Tabletas','5mg',1),
('Atorvastatina','Tabletas','20mg',1),
('Atorvastatina','Tabletas','40mg',1),
('Metoprolol','Tabletas','50mg',1),
('Metformina','Tabletas','500mg',1),
('Metformina','Tabletas','850mg',1),
('Glibenclamida','Tabletas','5mg',1),
('Salbutamol','Inhalador','100mcg/dosis',1),
('Cetirizina','Tabletas','10mg',1),
('Loratadina','Tabletas','10mg',1),
('Dexametasona','Tabletas','4mg',1),
('Dexametasona','Ampolleta','4mg/2ml',1),
('Prednisona','Tabletas','5mg',1),
('Vitamina C','Tabletas','500mg',1),
('Vitamina D3','Tabletas','1000 UI',1),
('Sulfato Ferroso','Tabletas','300mg',1),
('Ácido Fólico','Tabletas','5mg',1),
('Clotrimazol','Crema','1%',1),
('Fluconazol','Cápsulas','150mg',1),
('Alprazolam','Tabletas','0.5mg',1),
('Tramadol','Cápsulas','50mg',1);
