# Clínica Bienestar — Sistema de Gestión Médica

**Proyecto académico universitario** desarrollado por el equipo **DataBridge** como parte de un curso de Bases de Datos e Ingeniería de Software.

---

# Descripción del Proyecto

**Clínica Bienestar** es un sistema web de gestión médica desarrollado con **Laravel 12 (PHP 8.2)** y **MySQL**, orientado a digitalizar y centralizar los procesos administrativos y clínicos de una clínica médica.

El sistema busca facilitar la administración de pacientes, médicos y citas médicas mediante una plataforma web moderna, organizada y escalable.

El desarrollo se realiza utilizando la metodología ágil **SCRUM**, permitiendo implementar funcionalidades de forma progresiva mediante sprints.

La base de datos ha sido diseñada siguiendo principios de normalización hasta la **Tercera Forma Normal (3FN)** para garantizar integridad, consistencia y escalabilidad.

---

# Estado Actual del Desarrollo

Actualmente el proyecto se encuentra en una etapa inicial de implementación.

Durante el Sprint 2 se decidió simplificar temporalmente el alcance del sistema para concentrar el desarrollo en los módulos esenciales:

* Gestión de usuarios.
* Registro de pacientes.
* Registro de médicos.
* Administración de citas médicas.

Esta decisión permitió construir una base sólida y funcional, facilitando la configuración del entorno de desarrollo, la conexión con MySQL y la implementación de las funcionalidades principales.

Aunque el diseño de la base de datos contempla módulos adicionales como consultas médicas, recetas, historial médico y facturación, estas funcionalidades serán incorporadas progresivamente en futuros sprints.

Por esta razón, el modelo de datos incluye tablas que aún no son utilizadas completamente dentro del sistema actual, pero que forman parte de la planificación general del proyecto.

---

# Funcionalidades Implementadas

## Gestión de Usuarios

* Inicio de sesión.
* Control de acceso al sistema.
* Administración básica de usuarios.

## Gestión de Pacientes

* Registro de pacientes.
* Consulta de información de pacientes.
* Modificación de registros.

## Gestión de Médicos

* Registro de médicos.
* Gestión de especialidades.
* Actualización de información médica.

## Gestión de Citas

* Programación de citas.
* Consulta de citas registradas.
* Administración de estados de citas.

## Interfaz del Sistema

* Pantalla de inicio de sesión.
* Dashboard principal.
* Menú lateral de navegación.

---

# Funcionalidades Planificadas

Las siguientes funcionalidades forman parte del diseño general del sistema y serán desarrolladas en futuros sprints:

* Registro de consultas médicas.
* Generación de recetas médicas.
* Gestión de historial médico.
* Facturación de consultas.
* Generación de reportes.
* Auditoría de modificaciones.
* Estadísticas y métricas del sistema.

---

# Tecnologías Utilizadas

| Capa                    | Tecnología          |
| ----------------------- | ------------------- |
| Backend                 | Laravel 12          |
| Lenguaje Backend        | PHP 8.2             |
| Frontend                | HTML5, CSS3 y Blade |
| Base de Datos           | MySQL               |
| Control de Versiones    | Git y GitHub        |
| Gestión de Dependencias | Composer            |
| Herramientas Frontend   | NPM y Vite          |

---

# Diseño de Base de Datos

La estructura de la base de datos fue diseñada a partir del análisis de requerimientos realizado durante el proyecto académico.

Actualmente el sistema utiliza principalmente las siguientes entidades:

* USUARIO
* PACIENTE
* MEDICO
* CITA

Sin embargo, el modelo lógico y físico contempla además las siguientes entidades:

* CONSULTA
* RECETA
* FACTURA
* HISTORIAL_MEDICO

Estas tablas forman parte del diseño general del proyecto y serán integradas conforme se desarrollen las funcionalidades correspondientes.

---

# Equipo de Desarrollo DataBridge

| Integrante            | Responsabilidad Principal |
| --------------------- | ------------------------- |
| Christopher Canizalez | Diseño UI y Testing       |
| Adrian Hernandez      | Desarrollo Backend        |
| Steven Moran          | Base de Datos             |
| Daniel Leonardo       | Testing                   |
| Noé Alexander         | Documentación             |
| Eduardo Cuellar       | Coordinación General      |

---

# Estructura del Repositorio

```text
proyecto/
├── backend/          # Código Laravel, controladores y lógica del sistema
├── frontend/         # Vistas Blade y componentes visuales
├── database/         # Scripts SQL, migraciones y seeders
├── documentacion/    # Modelos, diagramas y entregables académicos
├── tests/            # Pruebas y validaciones
├── .gitignore
├── README.md
└── requisitos.txt
```

---

# Distribución de Responsabilidades

Cada integrante es responsable de mantener actualizada la carpeta asignada y colaborar con el resto del equipo cuando sea necesario.

## backend/ — Adrian Hernandez

Responsable de:

* Controladores Laravel.
* Rutas del sistema.
* Lógica de negocio.
* Integración con MySQL.
* Configuración del backend.

---

## frontend/ — Christopher Canizalez

Responsable de:

* Vistas Blade.
* Diseño visual.
* Dashboard.
* Experiencia de usuario.
* Integración visual con backend.

---

## database/ — Steven Moran

Responsable de:

* Modelo conceptual.
* Modelo lógico.
* Modelo físico.
* Scripts SQL.
* Migraciones.
* Diccionario de datos.

---

## documentacion/ — Noé Alexander

Responsable de:

* Documentación técnica.
* Diagramas ER.
* Manuales de usuario.
* Entregables académicos.
* Evidencias del proyecto.

---

## tests/ — Daniel Leonardo y Christopher Canizalez

Responsable de:

* Pruebas funcionales.
* Pruebas de integración.
* Validación de módulos.
* Reportes de errores.
* Seguimiento de incidencias.

---

## Coordinación General — Eduardo Cuellar

Responsable de:

* Organización general del proyecto.
* Gestión de ramas en GitHub.
* Seguimiento de avances.
* Revisión de Pull Requests.
* Actualización del README.
* Coordinación entre áreas de desarrollo.

---

# Flujo de Trabajo en GitHub

Para mantener una organización adecuada del proyecto se seguirá el siguiente flujo de trabajo:

1. Crear una rama para cada tarea o funcionalidad.
2. Realizar cambios localmente.
3. Subir cambios al repositorio remoto.
4. Crear un Pull Request.
5. Revisar cambios entre integrantes.
6. Integrar los cambios a la rama principal.

---

# Cómo Ejecutar el Proyecto

## 1. Clonar el repositorio

```bash
git clone https://github.com/usuario/clinica-bienestar.git
cd clinica-bienestar
```

## 2. Instalar dependencias

```bash
composer install
npm install
```

## 3. Configurar variables de entorno

```bash
cp .env.example .env
php artisan key:generate
```

## 4. Configurar la base de datos

Editar el archivo `.env` con las credenciales correspondientes:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinica_bienestar
DB_USERNAME=root
DB_PASSWORD=
```

## 5. Ejecutar migraciones

```bash
php artisan migrate
```

## 6. Iniciar el servidor

```bash
php artisan serve
```

Acceder desde:

```text
http://localhost:8000
```

---

# Metodología de Desarrollo

El proyecto utiliza la metodología ágil **SCRUM** para organizar el trabajo mediante sprints.

Cada sprint tiene como objetivo desarrollar funcionalidades específicas, realizar pruebas y documentar los avances obtenidos.

Beneficios de esta metodología:

* Organización del trabajo.
* Seguimiento del progreso.
* Entregas incrementales.
* Adaptación a cambios.
* Mejor colaboración entre integrantes.

---

# Acuerdos del Equipo

* Mantener una comunicación constante.
* Cumplir con las responsabilidades asignadas.
* Documentar los avances realizados.
* Utilizar GitHub para el control de versiones.
* Revisar los cambios antes de integrarlos.
* Apoyar al equipo cuando sea necesario.

---

# Créditos

Proyecto desarrollado por el equipo **DataBridge** para **Clínica Bienestar** como parte de una actividad académica orientada al diseño de bases de datos y desarrollo de sistemas web.

---

© DataBridge — Proyecto Académico.
