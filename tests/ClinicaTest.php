<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * Pruebas de funcionalidad — Clínica Bienestar
 * Tester: Daniel Leonardo
 * Fecha: 2026-06-02
 */
class ClinicaTest extends TestCase
{
    // =========================================================
    //  MÓDULO 1 — AUTENTICACIÓN
    // =========================================================

    /** CP-01: Login con credenciales correctas */
    public function test_login_con_credenciales_correctas()
    {
        DB::table('usuarios')->insert([
            'usuario'    => 'test_user',
            'contrasena' => 'test123',
            'rol'        => 'Secretaria', // ✅ CORREGIDO: rol con mayúscula según la BD
        ]);

        $response = $this->post('/login', [
            'usuario'    => 'test_user',
            'contrasena' => 'test123',
        ]);

        $response->assertRedirect('/inicio');

        DB::table('usuarios')->where('usuario', 'test_user')->delete();
    }

    /** CP-02: Login con contraseña incorrecta */
    public function test_login_con_contrasena_incorrecta()
    {
        DB::table('usuarios')->insert([
            'usuario'    => 'test_user2',
            'contrasena' => 'correcta123',
            'rol'        => 'Secretaria',
        ]);

        $response = $this->post('/login', [
            'usuario'    => 'test_user2',
            'contrasena' => 'incorrecta999',
        ]);

        $response->assertSessionHasErrors('login');

        DB::table('usuarios')->where('usuario', 'test_user2')->delete();
    }

    /** CP-03: Login con usuario inexistente */
    public function test_login_con_usuario_inexistente()
    {
        $response = $this->post('/login', [
            'usuario'    => 'usuario_que_no_existe',
            'contrasena' => 'cualquiera',
        ]);

        $response->assertSessionHasErrors('login');
    }

    /** CP-04: Acceso directo al dashboard sin sesión */
    public function test_acceso_a_inicio_sin_sesion_redirige_al_login()
    {
        $response = $this->get('/inicio');
        $response->assertRedirect('/');
    }

    /** CP-04b: Acceso directo a citas sin sesión */
    public function test_acceso_a_citas_sin_sesion_redirige_al_login()
    {
        $response = $this->get('/citas');
        $response->assertRedirect('/');
    }

    /** CP-04c: Acceso directo a pacientes sin sesión */
    public function test_acceso_a_pacientes_sin_sesion_redirige_al_login()
    {
        $response = $this->get('/pacientes');
        $response->assertRedirect('/');
    }

    /** CP-05: Cerrar sesión */
    public function test_cerrar_sesion_destruye_la_sesion()
    {
        $response = $this->withSession(['usuario' => 'admin', 'rol' => 'Administrador'])
                         ->get('/cerrar-sesion');

        $response->assertRedirect('/');
        $this->assertEmpty(session('usuario'));
    }

    // =========================================================
    //  MÓDULO 2 — DASHBOARD
    // =========================================================

    /** CP-06: Dashboard carga correctamente con sesión */
    public function test_dashboard_carga_con_sesion_activa()
    {
        $response = $this->withSession(['usuario' => 'admin', 'rol' => 'Administrador'])
                         ->get('/inicio');

        $response->assertStatus(200);
    }

    // =========================================================
    //  MÓDULO 3 — CITAS
    // =========================================================

    /** CP-09: Lista de citas carga correctamente */
    public function test_lista_de_citas_carga_con_sesion_activa()
    {
        $response = $this->withSession(['usuario' => 'admin', 'rol' => 'Administrador'])
                         ->get('/citas');

        $response->assertStatus(200);
    }

    /** CP-10: Guardar nueva cita con paciente existente */
    public function test_guardar_nueva_cita_paciente_existente()
    {
        $paciente = DB::table('pacientes')->first();
        $medico   = DB::table('medicos')->first();

        if (!$paciente || !$medico) {
            $this->markTestSkipped('Se necesitan pacientes y médicos en la BD para esta prueba.');
        }

        $response = $this->withSession(['usuario' => 'admin', 'rol' => 'Administrador'])
                         ->postJson('/citas', [
                             'dui_paciente' => $paciente->dui,
                             'dui_medico'   => $medico->dui,
                             'tipo_cita'    => 'consulta',
                             'fecha'        => '2026-12-01',
                             'hora'         => '10:00',
                             'motivo'       => 'Prueba automatizada',
                             'estado'       => 'programada',
                         ]);

        $response->assertJson(['success' => true]);

        DB::table('citas')->where('motivo', 'Prueba automatizada')->delete();
    }

    /** CP-10b: ✅ NUEVO — Guardar paciente nuevo y luego su cita (flujo corregido) */
    public function test_guardar_cita_con_paciente_nuevo()
    {
        $medico = DB::table('medicos')->first();

        if (!$medico) {
            $this->markTestSkipped('Se necesita al menos un médico en la BD para esta prueba.');
        }

        // Paso 1: guardar el paciente nuevo
        $resPaciente = $this->withSession(['usuario' => 'admin', 'rol' => 'Administrador'])
                            ->postJson('/paciente/guardar', [
                                'nombre'           => 'Paciente',
                                'apellido'         => 'NuevoCita',
                                'dui'              => '77777777-7',
                                'telefono'         => '7000-0001',
                                'edad'             => 30,
                                'fecha_nacimiento' => '',
                                'direccion'        => 'Dirección prueba',
                            ]);

        $resPaciente->assertJson(['success' => true]);

        // Paso 2: guardar la cita con ese paciente
        $resCita = $this->withSession(['usuario' => 'admin', 'rol' => 'Administrador'])
                        ->postJson('/citas', [
                            'dui_paciente' => '77777777-7',
                            'dui_medico'   => $medico->dui,
                            'tipo_cita'    => 'consulta',
                            'fecha'        => '2026-12-10',
                            'hora'         => '11:00',
                            'motivo'       => 'Cita con paciente nuevo',
                            'estado'       => 'programada',
                        ]);

        $resCita->assertJson(['success' => true]);

        // Limpieza (citas primero por FK)
        DB::table('citas')->where('motivo', 'Cita con paciente nuevo')->delete();
        DB::table('pacientes')->where('dui', '77777777-7')->delete();
    }

    /** CP-11: Editar una cita existente */
    public function test_editar_cita_existente()
    {
        $paciente = DB::table('pacientes')->first();
        $medico   = DB::table('medicos')->first();

        if (!$paciente || !$medico) {
            $this->markTestSkipped('Se necesitan pacientes y médicos en la BD para esta prueba.');
        }

        $id = DB::table('citas')->insertGetId([
            'dui_paciente' => $paciente->dui,
            'dui_medico'   => $medico->dui,
            'tipo_cita'    => 'consulta',
            'fecha'        => '2026-12-20',
            'hora'         => '08:00',
            'motivo'       => 'Motivo original',
            'estado'       => 'programada',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $response = $this->withSession(['usuario' => 'admin', 'rol' => 'Administrador'])
                         ->putJson("/citas/{$id}", [
                             'dui_paciente' => $paciente->dui,
                             'dui_medico'   => $medico->dui,
                             'tipo_cita'    => 'control',
                             'fecha'        => '2026-12-20',
                             'hora'         => '09:00',
                             'motivo'       => 'Motivo actualizado',
                             'estado'       => 'confirmada',
                         ]);

        $response->assertJson(['success' => true]);

        // Verificar que el cambio se aplicó
        $cita = DB::table('citas')->where('id_cita', $id)->first();
        $this->assertEquals('Motivo actualizado', $cita->motivo);
        $this->assertEquals('confirmada', $cita->estado);

        DB::table('citas')->where('id_cita', $id)->delete();
    }

    /** CP-12: Eliminar cita */
    public function test_eliminar_cita()
    {
        $paciente = DB::table('pacientes')->first();
        $medico   = DB::table('medicos')->first();

        if (!$paciente || !$medico) {
            $this->markTestSkipped('Se necesitan pacientes y médicos en la BD para esta prueba.');
        }

        $id = DB::table('citas')->insertGetId([
            'dui_paciente' => $paciente->dui,
            'dui_medico'   => $medico->dui,
            'tipo_cita'    => 'consulta',
            'fecha'        => '2026-12-15',
            'hora'         => '09:00',
            'motivo'       => 'Cita para eliminar',
            'estado'       => 'programada',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        $response = $this->withSession(['usuario' => 'admin', 'rol' => 'Administrador'])
                         ->deleteJson("/citas/{$id}");

        $response->assertJson(['success' => true]);
        $this->assertNull(DB::table('citas')->where('id_cita', $id)->first());
    }

    // =========================================================
    //  MÓDULO 4 — PACIENTES
    // =========================================================

    /** CP-14: Lista de pacientes carga correctamente */
    public function test_lista_de_pacientes_carga_con_sesion_activa()
    {
        $response = $this->withSession(['usuario' => 'admin', 'rol' => 'Administrador'])
                         ->get('/pacientes');

        $response->assertStatus(200);
    }

    /** CP-15: Registrar nuevo paciente */
    public function test_registrar_nuevo_paciente()
    {
        $response = $this->withSession(['usuario' => 'admin', 'rol' => 'Administrador'])
                         ->postJson('/paciente/guardar', [
                             'nombre'           => 'Prueba',
                             'apellido'         => 'Testing',
                             'dui'              => '00000000-0',
                             'telefono'         => '7777-0000',
                             'edad'             => 25,
                             'fecha_nacimiento' => '2001-01-01',
                             'direccion'        => 'Dirección de prueba',
                         ]);

        $response->assertJson(['success' => true]);

        // Verificar que existe en la BD
        $this->assertNotNull(DB::table('pacientes')->where('dui', '00000000-0')->first());

        DB::table('pacientes')->where('dui', '00000000-0')->delete();
    }

    /** CP-16: Registrar paciente con DUI duplicado */
    public function test_registrar_paciente_dui_duplicado()
    {
        // Insertar paciente base
        DB::table('pacientes')->insert([
            'nombre'     => 'Original',
            'apellido'   => 'Paciente',
            'dui'        => '88888888-8',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Intentar insertar con el mismo DUI
        $response = $this->withSession(['usuario' => 'admin', 'rol' => 'Administrador'])
                         ->postJson('/paciente/guardar', [
                             'nombre'   => 'Duplicado',
                             'apellido' => 'Error',
                             'dui'      => '88888888-8',
                         ]);

        $response->assertJson(['success' => false]);

        DB::table('pacientes')->where('dui', '88888888-8')->delete();
    }

    /** CP-17: ✅ NUEVO — Actualizar datos de un paciente */
    public function test_actualizar_paciente()
    {
        DB::table('pacientes')->insert([
            'nombre'     => 'Antes',
            'apellido'   => 'Update',
            'dui'        => '66666666-6',
            'telefono'   => '6000-0000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->withSession(['usuario' => 'admin', 'rol' => 'Administrador'])
                         ->postJson('/paciente/actualizar', [
                             'dui_original'     => '66666666-6',
                             'nombre'           => 'Despues',
                             'apellido'         => 'Update',
                             'dui'              => '66666666-6',
                             'telefono'         => '6111-1111',
                             'edad'             => 40,
                             'fecha_nacimiento' => '1984-01-01',
                             'direccion'        => 'Nueva dirección',
                         ]);

        $response->assertJson(['success' => true]);

        $paciente = DB::table('pacientes')->where('dui', '66666666-6')->first();
        $this->assertEquals('Despues', $paciente->nombre);
        $this->assertEquals('6111-1111', $paciente->telefono);

        DB::table('pacientes')->where('dui', '66666666-6')->delete();
    }

    /** CP-18: Consultar datos de paciente por DUI */
    public function test_consultar_datos_de_paciente_existente()
    {
        $paciente = DB::table('pacientes')->first();

        if (!$paciente) {
            $this->markTestSkipped('Se necesita al menos un paciente en la BD para esta prueba.');
        }

        $response = $this->withSession(['usuario' => 'admin', 'rol' => 'Administrador'])
                         ->getJson("/paciente/{$paciente->dui}/datos");

        $response->assertJson(['success' => true]);
        $response->assertJsonStructure(['success', 'paciente' => ['dui', 'nombre', 'apellido']]);
    }

    /** CP-18b: Consultar paciente con DUI inexistente */
    public function test_consultar_paciente_con_dui_inexistente()
    {
        $response = $this->withSession(['usuario' => 'admin', 'rol' => 'Administrador'])
                         ->getJson('/paciente/99-9999999-9/datos');

        $response->assertJson(['success' => false]);
    }
}
