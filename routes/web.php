<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Mostrar login
Route::get('/', function () {
    return view('login');
})->name('login');

// Procesar login (USUARIOS FIJOS - sin BD por ahora)
Route::post('/login', function (Request $request) {
    $usuarios = [
        'admin'     => ['pass' => 'Admin@2024!',  'rol' => 'Administrador'],
        'secretaria'=> ['pass' => 'Secre@2024!',  'rol' => 'Secretaria'],
    ];

    $user = $request->input('usuario');
    $pass = $request->input('contrasena');

    if (isset($usuarios[$user]) && $pass === $usuarios[$user]['pass']) {
        session(['usuario' => $user, 'rol' => $usuarios[$user]['rol']]);
        return redirect('/inicio');
    }

    return back()->withErrors(['login' => 'Usuario o contraseña incorrectos.']);
})->name('login.post');

// Dashboard (CON BASE DE DATOS REAL)
Route::get('/inicio', function () {
    if (!session('usuario')) return redirect('/');

    $pacientes_inicio   = DB::select("SELECT dui, nombre, apellido FROM pacientes ORDER BY nombre, apellido");
    $medicos_inicio     = DB::select("SELECT dui, nombre, apellido FROM medicos ORDER BY nombre");
    $citas_hoy          = DB::selectOne("SELECT COUNT(*) AS total FROM citas WHERE fecha = CURDATE() AND estado NOT IN ('cancelada')")->total ?? 0;
    $citas_proximas     = DB::selectOne("SELECT COUNT(*) AS total FROM citas WHERE fecha > CURDATE() AND estado NOT IN ('cancelada','completada')")->total ?? 0;
    $emergencias        = DB::selectOne("SELECT COUNT(*) AS total FROM citas WHERE tipo_cita = 'urgencia' AND estado NOT IN ('cancelada','completada')")->total ?? 0;
    $total_pacientes    = DB::selectOne("SELECT COUNT(*) AS total FROM pacientes")->total ?? 0;
    $agenda_hoy         = DB::select("SELECT c.hora, c.motivo, p.nombre AS pac_nombre, p.apellido AS pac_apellido, CONCAT(m.nombre,' ',m.apellido) AS medico FROM citas c JOIN pacientes p ON p.dui = c.dui_paciente JOIN medicos m ON m.dui = c.dui_medico WHERE c.fecha = CURDATE() ORDER BY c.hora ASC LIMIT 5");
    $actividad_reciente = DB::select("SELECT c.fecha, c.motivo, p.nombre AS pac_nombre, p.apellido AS pac_apellido FROM citas c JOIN pacientes p ON p.dui = c.dui_paciente WHERE c.estado = 'completada' ORDER BY c.fecha DESC LIMIT 5");

    return view('inicio', compact('pacientes_inicio','medicos_inicio','citas_hoy','citas_proximas','emergencias','total_pacientes','agenda_hoy','actividad_reciente'));
})->name('inicio');

// Citas — carga datos reales de la BD
Route::get('/citas', function () {
    if (!session('usuario')) return redirect('/');

    $citas = DB::select("
        SELECT
            c.id_cita,
            c.dui_paciente,
            c.dui_medico,
            p.nombre AS pac_nombre,
            p.apellido AS pac_apellido,
            p.edad,
            p.telefono,
            CONCAT(m.nombre,' ',m.apellido) AS medico,
            c.tipo_cita,
            c.fecha,
            c.hora,
            c.motivo,
            c.estado
        FROM citas c
        JOIN pacientes p ON p.dui = c.dui_paciente
        JOIN medicos   m ON m.dui = c.dui_medico
        ORDER BY c.fecha DESC, c.hora DESC
    ");

    $pacientes = DB::select("SELECT dui, nombre, apellido, edad, telefono FROM pacientes ORDER BY nombre, apellido");
    $medicos   = DB::select("SELECT dui, nombre, apellido FROM medicos ORDER BY nombre");

    return view('citas', compact('citas', 'pacientes', 'medicos'));
})->name('citas');

// Guardar nueva cita (devuelve JSON para AJAX)
Route::post('/citas', function (Request $request) {
    if (!session('usuario')) return response()->json(['success' => false, 'message' => 'No autorizado']);
    
    try {
        $id = DB::table('citas')->insertGetId([
            'dui_paciente' => $request->input('dui_paciente'),
            'dui_medico'   => $request->input('dui_medico'),
            'tipo_cita'    => $request->input('tipo_cita'),
            'fecha'        => $request->input('fecha'),
            'hora'         => $request->input('hora'),
            'motivo'       => $request->input('motivo'),
            'estado'       => $request->input('estado', 'programada'),
            'created_at'   => now(),
            'updated_at'   => now()
        ]);
        
        return response()->json(['success' => true, 'id' => $id]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
})->name('citas.store');

// Actualizar cita existente (EDITAR - devuelve JSON para AJAX)
Route::put('/citas/{id}', function (Request $request, $id) {
    if (!session('usuario')) return response()->json(['success' => false, 'message' => 'No autorizado']);
    
    try {
        DB::table('citas')
            ->where('id_cita', $id)
            ->update([
                'dui_paciente' => $request->input('dui_paciente'),
                'dui_medico'   => $request->input('dui_medico'),
                'tipo_cita'    => $request->input('tipo_cita'),
                'fecha'        => $request->input('fecha'),
                'hora'         => $request->input('hora'),
                'motivo'       => $request->input('motivo'),
                'estado'       => $request->input('estado', 'programada'),
                'updated_at'   => now()
            ]);
        
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
})->name('citas.update');

// Cancelar/eliminar cita (devuelve JSON para AJAX)
Route::delete('/citas/{id}', function ($id) {
    if (!session('usuario')) return response()->json(['success' => false, 'message' => 'No autorizado']);

    try {
        $deleted = DB::table('citas')->where('id_cita', $id)->delete();

        if ($deleted) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Cita no encontrada']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
})->name('citas.destroy');

// Guardar cita rápida desde inicio (devuelve JSON para AJAX)
Route::post('/citas/rapida', function (Request $request) {
    if (!session('usuario')) return response()->json(['success' => false, 'message' => 'No autorizado']);

    try {
        DB::table('citas')->insert([
            'dui_paciente' => $request->input('dui_paciente'),
            'dui_medico'   => $request->input('dui_medico'),
            'tipo_cita'    => $request->input('tipo_cita', 'consulta'),
            'fecha'        => $request->input('fecha'),
            'hora'         => $request->input('hora'),
            'motivo'       => $request->input('motivo'),
            'estado'       => 'programada',
            'created_at'   => now(),
            'updated_at'   => now()
        ]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
})->name('citas.rapida');

// Pacientes (CON BASE DE DATOS REAL)
Route::get('/pacientes', function () {
    if (!session('usuario')) return redirect('/');
    
    $pacientes = DB::select("SELECT dui, nombre, apellido, telefono, edad, fecha_nacimiento, direccion FROM pacientes ORDER BY nombre, apellido");
    
    return view('pacientes', compact('pacientes'));
})->name('pacientes');

// Obtener datos de un paciente específico (para editar)
Route::get('/paciente/{dui}/datos', function ($dui) {
    if (!session('usuario')) return response()->json(['success' => false, 'message' => 'No autorizado']);
    
    $paciente = DB::selectOne("SELECT dui, nombre, apellido, telefono, edad, fecha_nacimiento, direccion FROM pacientes WHERE dui = ?", [$dui]);
    
    if ($paciente) {
        return response()->json(['success' => true, 'paciente' => $paciente]);
    }
    return response()->json(['success' => false, 'message' => 'Paciente no encontrado']);
})->name('paciente.datos');

// Guardar nuevo paciente (desde inicio o cualquier modal)
Route::post('/paciente/guardar', function (Request $request) {
    if (!session('usuario')) return response()->json(['success' => false, 'message' => 'No autorizado']);

    try {
        DB::table('pacientes')->insert([
            'nombre'           => $request->input('nombre'),
            'apellido'         => $request->input('apellido'),
            'dui'              => $request->input('dui'),
            'telefono'         => $request->input('telefono'),
            'edad'             => $request->input('edad'),
            'fecha_nacimiento' => $request->input('fecha_nacimiento'),
            'direccion'        => $request->input('direccion'),
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
})->name('paciente.guardar');

// Actualizar paciente
Route::post('/paciente/actualizar', function (Request $request) {
    if (!session('usuario')) return response()->json(['success' => false, 'message' => 'No autorizado']);
    
    $data = $request->all();
    
    try {
        DB::update("UPDATE pacientes SET 
            nombre = ?, 
            apellido = ?, 
            dui = ?, 
            telefono = ?, 
            edad = ?, 
            fecha_nacimiento = ?, 
            direccion = ? 
            WHERE dui = ?", [
            $data['nombre'],
            $data['apellido'],
            $data['dui'],
            $data['telefono'],
            $data['edad'] ?: null,
            $data['fecha_nacimiento'] ?: null,
            $data['direccion'],
            $data['dui_original']
        ]);
        
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error al actualizar: ' . $e->getMessage()]);
    }
})->name('paciente.actualizar');

// Cerrar sesión
Route::get('/cerrar-sesion', function () {
    session()->flush();
    return redirect('/');
})->name('logout');