# Casos de Prueba — Clínica Bienestar

**Tester:** Daniel Leonardo  
**Fecha:** 2026-06-02  
**Sistema:** Sistema de Gestión de Clínica Médica

---

## MÓDULO 1 — AUTENTICACIÓN

### CP-01: Login con credenciales correctas

| Campo                  | Detalle                                                            |
| ---------------------- | ------------------------------------------------------------------ |
| **Precondición**       | El usuario existe en la base de datos                              |
| **Acción**             | Ingresar usuario y contraseña válidos y presionar "Iniciar Sesión" |
| **Resultado esperado** | Redirige al dashboard `/inicio`                                    |
| **Resultado obtenido** |                                                                    |
| **Estado**             | ✅ Pasa                                                            |

---

### CP-02: Login con contraseña incorrecta

| Campo                  | Detalle                                                |
| ---------------------- | ------------------------------------------------------ |
| **Precondición**       | El usuario existe en la base de datos                  |
| **Acción**             | Ingresar usuario correcto pero contraseña incorrecta   |
| **Resultado esperado** | Muestra el mensaje "Usuario o contraseña incorrectos." |
| **Resultado obtenido** |                                                        |
| **Estado**             | ✅ Pasa                                                |

---

### CP-03: Login con usuario inexistente

| Campo                  | Detalle                                                |
| ---------------------- | ------------------------------------------------------ |
| **Precondición**       | Ninguna                                                |
| **Acción**             | Ingresar un usuario que no existe en la base de datos  |
| **Resultado esperado** | Muestra el mensaje "Usuario o contraseña incorrectos." |
| **Resultado obtenido** |                                                        |
| **Estado**             | ✅ Pasa                                                |

---

### CP-04: Acceso directo al dashboard sin sesión

| Campo                  | Detalle                                               |
| ---------------------- | ----------------------------------------------------- |
| **Precondición**       | El usuario NO ha iniciado sesión                      |
| **Acción**             | Ingresar manualmente la URL `/inicio` en el navegador |
| **Resultado esperado** | Redirige al login `/`                                 |
| **Resultado obtenido** |                                                       |
| **Estado**             | ✅ Pasa                                               |

---

### CP-05: Cerrar sesión

| Campo                  | Detalle                                   |
| ---------------------- | ----------------------------------------- |
| **Precondición**       | El usuario tiene sesión activa            |
| **Acción**             | Hacer clic en "Cerrar Sesión"             |
| **Resultado esperado** | La sesión se destruye y redirige al login |
| **Resultado obtenido** |                                           |
| **Estado**             | ✅ Pasa                                   |

---

## MÓDULO 2 — DASHBOARD (INICIO)

### CP-06: Visualización de contadores del dashboard

| Campo                  | Detalle                                                                             |
| ---------------------- | ----------------------------------------------------------------------------------- |
| **Precondición**       | Usuario con sesión activa                                                           |
| **Acción**             | Ingresar al dashboard `/inicio`                                                     |
| **Resultado esperado** | Se muestran los contadores: Citas Hoy, Próximas Citas, Emergencias, Total Pacientes |
| **Resultado obtenido** |                                                                                     |
| **Estado**             | ✅ Pasa                                                                             |

---

### CP-07: Agenda del día en el dashboard

| Campo                  | Detalle                                                                    |
| ---------------------- | -------------------------------------------------------------------------- |
| **Precondición**       | Existen citas programadas para hoy                                         |
| **Acción**             | Revisar la sección "Agenda de Hoy" en el dashboard                         |
| **Resultado esperado** | Muestra máximo 5 citas ordenadas por hora con nombre del paciente y médico |
| **Resultado obtenido** |                                                                            |
| **Estado**             | ✅ Pasa                                                                    |

---

### CP-08: Cita rápida desde el dashboard

| Campo                  | Detalle                                          |
| ---------------------- | ------------------------------------------------ |
| **Precondición**       | Existen pacientes y médicos registrados          |
| **Acción**             | Llenar el formulario de cita rápida y enviar     |
| **Resultado esperado** | La cita se guarda y aparece en la lista de citas |
| **Resultado obtenido** |                                                  |
| **Estado**             | ✅ Pasa                                          |

---

## MÓDULO 3 — CITAS

### CP-09: Visualización de lista de citas

| Campo                  | Detalle                                                                                   |
| ---------------------- | ----------------------------------------------------------------------------------------- |
| **Precondición**       | Usuario con sesión activa                                                                 |
| **Acción**             | Navegar a `/citas`                                                                        |
| **Resultado esperado** | Se muestra la tabla con todas las citas incluyendo paciente, médico, fecha, hora y estado |
| **Resultado obtenido** |                                                                                           |
| **Estado**             | ✅ Pasa                                                                                   |

---

### CP-10: Registrar nueva cita

| Campo                  | Detalle                                                           |
| ---------------------- | ----------------------------------------------------------------- |
| **Precondición**       | Existen pacientes y médicos registrados                           |
| **Acción**             | Llenar el formulario de nueva cita con todos los campos y guardar |
| **Resultado esperado** | La cita aparece en la lista con estado "programada"               |
| **Resultado obtenido** |                                                                   |
| **Estado**             | ✅ Pasa                                                           |

---

### CP-11: Editar una cita existente

| Campo                  | Detalle                                                        |
| ---------------------- | -------------------------------------------------------------- |
| **Precondición**       | Existe al menos una cita registrada                            |
| **Acción**             | Seleccionar una cita, modificar el motivo o la fecha y guardar |
| **Resultado esperado** | Los datos de la cita se actualizan correctamente               |
| **Resultado obtenido** |                                                                |
| **Estado**             | ✅ Pasa                                                        |

---

### CP-12: Cancelar/Eliminar una cita

| Campo                  | Detalle                                                |
| ---------------------- | ------------------------------------------------------ |
| **Precondición**       | Existe al menos una cita registrada                    |
| **Acción**             | Seleccionar una cita y hacer clic en eliminar/cancelar |
| **Resultado esperado** | La cita desaparece de la lista                         |
| **Resultado obtenido** |                                                        |
| **Estado**             | ✅ Pasa                                                |

---

### CP-13: Acceso no autorizado a citas sin sesión

| Campo                  | Detalle                                          |
| ---------------------- | ------------------------------------------------ |
| **Precondición**       | El usuario NO tiene sesión activa                |
| **Acción**             | Ingresar directamente a `/citas` en el navegador |
| **Resultado esperado** | Redirige al login `/`                            |
| **Resultado obtenido** |                                                  |
| **Estado**             | ✅ Pasa                                          |

---

## MÓDULO 4 — PACIENTES

### CP-14: Visualización de lista de pacientes

| Campo                  | Detalle                                                 |
| ---------------------- | ------------------------------------------------------- |
| **Precondición**       | Usuario con sesión activa                               |
| **Acción**             | Navegar a `/pacientes`                                  |
| **Resultado esperado** | Se muestra la tabla con todos los pacientes registrados |
| **Resultado obtenido** |                                                         |
| **Estado**             | ✅ Pasa                                                 |

---

### CP-15: Registrar nuevo paciente

| Campo                  | Detalle                                                                              |
| ---------------------- | ------------------------------------------------------------------------------------ |
| **Precondición**       | Usuario con sesión activa                                                            |
| **Acción**             | Llenar el formulario de nuevo paciente con DUI, nombre, apellido, teléfono y guardar |
| **Resultado esperado** | El paciente aparece en la lista                                                      |
| **Resultado obtenido** |                                                                                      |
| **Estado**             | ✅ Pasa                                                                              |

---

### CP-16: Registrar paciente con DUI duplicado

| Campo                  | Detalle                                              |
| ---------------------- | ---------------------------------------------------- |
| **Precondición**       | Existe un paciente con DUI registrado                |
| **Acción**             | Intentar registrar otro paciente con el mismo DUI    |
| **Resultado esperado** | El sistema muestra un error y no guarda el duplicado |
| **Resultado obtenido** |                                                      |

| **Estado** ⬜ Pendiente

---

### CP-17: Editar datos de un paciente

| Campo                  | Detalle                                                              |
| ---------------------- | -------------------------------------------------------------------- |
| **Precondición**       | Existe al menos un paciente registrado                               |
| **Acción**             | Seleccionar un paciente, modificar el teléfono o dirección y guardar |
| **Resultado esperado** | Los datos del paciente se actualizan correctamente                   |
| **Resultado obtenido** |                                                                      |
| **Estado**             | ✅ Pasa                                                              |

---

### CP-18: Consultar datos de un paciente específico

| Campo                  | Detalle                                                    |
| ---------------------- | ---------------------------------------------------------- |
| **Precondición**       | Existe al menos un paciente registrado                     |
| **Acción**             | Llamar a la ruta `/paciente/{dui}/datos` con un DUI válido |
| **Resultado esperado** | Devuelve JSON con los datos del paciente                   |
| **Resultado obtenido** |                                                            |
| **Estado**             | ⬜ Pendiente                                               |

---

## RESUMEN DE RESULTADOS

| Total casos | ✅ Pasan | ❌ Fallan | ⬜ Pendientes |
| ----------- | -------- | --------- | ------------- |
| 18          | 16       | 0         | 2             |

---

_Documento generado para el proyecto DataBridge — Instituto Nacional de Acajutla_
