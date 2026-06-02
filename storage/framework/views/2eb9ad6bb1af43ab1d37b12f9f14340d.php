<?php
    $rol    = session('rol', 'desconocido');
    $nombre = session('usuario', 'Usuario');

    $roles_info = [
        'Administrador'   => ['label' => 'Administrador',   'color' => '#1a56db', 'bg' => '#eef2ff'],
        'Secretaria'      => ['label' => 'Secretaria',      'color' => '#0891b2', 'bg' => '#ecfeff'],
        'medico_general'  => ['label' => 'Médico General',  'color' => '#059669', 'bg' => '#ecfdf5'],
        'medico_pediatra' => ['label' => 'Médico Pediatra', 'color' => '#7c3aed', 'bg' => '#f5f3ff'],
    ];
    $info = $roles_info[$rol] ?? ['label' => ucfirst($rol), 'color' => '#6b7280', 'bg' => '#f9fafb'];

    $hora = (int)date('H');
    $saludo = $hora < 12 ? '¡Buenos días' : ($hora < 19 ? '¡Buenas tardes' : '¡Buenas noches');
    $emoji_saludo = $hora < 12 ? '👋' : ($hora < 19 ? '☀️' : '🌙');

    $mes_actual  = (int)date('n');
    $anio_actual = (int)date('Y');
    $dia_actual  = (int)date('j');
    $nombre_meses = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    $dias_en_mes  = cal_days_in_month(CAL_GREGORIAN, $mes_actual, $anio_actual);
    $primer_dia   = (int)date('w', mktime(0,0,0,$mes_actual,1,$anio_actual));

    $menu = [
        ['id'=>'inicio',       'label'=>'Inicio',       'icono'=>'home',      'href'=>route('inicio')],
        ['id'=>'citas',        'label'=>'Citas',        'icono'=>'calendar',  'href'=>route('citas')],
        ['id'=>'pacientes',    'label'=>'Pacientes',    'icono'=>'users',     'href'=>route('pacientes')],
        ['id'=>'historiales',  'label'=>'Historiales',  'icono'=>'clipboard', 'href'=>'#'],
        ['id'=>'recetas',      'label'=>'Recetas',      'icono'=>'file-text', 'href'=>'#'],
        ['id'=>'laboratorio',  'label'=>'Laboratorio',  'icono'=>'flask',     'href'=>'#'],
        ['id'=>'facturacion',  'label'=>'Facturación',  'icono'=>'dollar',    'href'=>'#'],
        ['id'=>'reportes',     'label'=>'Reportes',     'icono'=>'bar-chart', 'href'=>'#'],
        ['id'=>'mensajes',     'label'=>'Mensajes',     'icono'=>'message',   'href'=>'#'],
        ['id'=>'configuracion','label'=>'Configuración','icono'=>'settings',  'href'=>'#'],
    ];

    function svg_icon(string $name): string {
        $icons = [
            'home'      => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>',
            'calendar'  => '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
            'users'     => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
            'clipboard' => '<path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/>',
            'file-text' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>',
            'flask'     => '<path d="M9 3h6"/><path d="M10 3v7.5L5 21h14L14 10.5V3"/>',
            'dollar'    => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>',
            'bar-chart' => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>',
            'message'   => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
            'settings'  => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>',
            'bell'      => '<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/>',
            'chat'      => '<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>',
            'logout'    => '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>',
            'chevron-r' => '<polyline points="9 18 15 12 9 6"/>',
            'chevron-l' => '<polyline points="15 18 9 12 15 6"/>',
            'chevron-d' => '<polyline points="6 9 12 15 18 9"/>',
            'menu'      => '<line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/>',
            'help'      => '<circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
            'plus-user' => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>',
            'search'    => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
            'note'      => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/>',
            'clock'     => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
            'shield'    => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
            'plus'      => '<line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>',
            'check'     => '<polyline points="20 6 9 13.5 4 8.5"/>',
            'x'         => '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',
        ];
        return $icons[$name] ?? '';
    }

    function icon(string $name, int $size = 20, string $extra = ''): string {
        $d = svg_icon($name);
        return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" '.$extra.'>'.$d.'</svg>';
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inicio – Clínica Bienestar</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--blue:#1a56db;--blue-dark:#1341b0;--blue-light:#eef2ff;--blue-mid:#3b82f6;--green:#059669;--green-light:#ecfdf5;--orange:#d97706;--orange-light:#fffbeb;--red:#dc2626;--red-light:#fef2f2;--cyan:#0891b2;--cyan-light:#ecfeff;--purple:#7c3aed;--purple-light:#f5f3ff;--text-dark:#111827;--text-mid:#4b5563;--text-soft:#9ca3af;--border:#e5e7eb;--bg:#f3f6fb;--white:#ffffff;--sidebar-w:220px;--topbar-h:64px;--radius:12px;--radius-sm:8px;--shadow:0 2px 12px rgba(0,0,0,.07);--shadow-md:0 4px 20px rgba(0,0,0,.10);--shadow-lg:0 8px 40px rgba(0,0,0,.14)}
html,body{height:100%;font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--text-dark);font-size:14px}
.app{display:flex;height:100vh;overflow:hidden}
.sidebar{width:var(--sidebar-w);background:var(--white);border-right:1px solid var(--border);display:flex;flex-direction:column;flex-shrink:0;height:100vh;overflow-y:auto;position:relative;z-index:10}
.sidebar-brand{display:flex;align-items:center;gap:12px;padding:18px 18px 16px;border-bottom:1px solid var(--border);text-decoration:none;pointer-events:none;cursor:default}
.brand-logo-sm{width:46px;height:46px;background:transparent;border-radius:0;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:none}
.brand-logo-sm img{width:44px;height:44px;object-fit:contain;display:block}
.brand-texts{display:flex;flex-direction:column;line-height:1.1}
.brand-texts .t1{font-size:.72rem;color:var(--text-soft);font-weight:600}
.brand-texts .t2{font-family:'Nunito',sans-serif;font-size:1.15rem;font-weight:900;color:var(--text-dark)}
.sidebar-nav{padding:12px 10px;flex:1}
.sidebar-nav a{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:var(--radius-sm);text-decoration:none;color:var(--text-mid);font-weight:600;font-size:.88rem;transition:background .15s,color .15s;margin-bottom:2px}
.sidebar-nav a:hover{background:var(--bg);color:var(--blue)}
.sidebar-nav a.active{background:var(--blue);color:var(--white)}
.sidebar-help{padding:12px 14px 18px;border-top:1px solid var(--border)}
.help-btn{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:var(--radius-sm);background:var(--bg);cursor:pointer;font-size:.85rem;font-weight:600;color:var(--text-mid);transition:background .15s}
.help-btn:hover{background:var(--blue-light);color:var(--blue)}
.help-sub{font-size:.75rem;font-weight:400;color:var(--text-soft)}
.main{flex:1;display:flex;flex-direction:column;overflow:hidden}
.topbar{height:var(--topbar-h);background:var(--white);border-bottom:1px solid var(--border);display:flex;align-items:center;padding:0 24px;gap:16px;flex-shrink:0}
.topbar-menu-btn{background:none;border:none;cursor:pointer;color:var(--text-mid);display:flex;align-items:center;padding:6px;border-radius:6px;transition:background .15s}
.topbar-menu-btn:hover{background:var(--bg)}
.topbar-spacer{flex:1}
.topbar-actions{display:flex;align-items:center;gap:8px}
.icon-btn{position:relative;background:none;border:none;width:38px;height:38px;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;color:var(--text-mid);transition:background .15s,color .15s}
.icon-btn:hover{background:var(--bg);color:var(--blue)}
.badge{position:absolute;top:3px;right:3px;background:var(--red);color:#fff;border-radius:50%;width:16px;height:16px;font-size:.65rem;font-weight:800;display:flex;align-items:center;justify-content:center;border:2px solid #fff}
.user-chip-wrap{position:relative}
.user-chip{display:flex;align-items:center;gap:10px;padding:5px 10px 5px 5px;border-radius:50px;border:1px solid var(--border);cursor:pointer;transition:background .15s;margin-left:4px}
.user-chip:hover{background:var(--bg)}
.user-avatar{width:34px;height:34px;border-radius:50%;background:var(--blue-light);display:flex;align-items:center;justify-content:center;color:var(--blue);font-weight:800;font-size:.85rem;flex-shrink:0}
.user-info{display:flex;flex-direction:column;line-height:1.15}
.user-info .uname{font-weight:700;font-size:.85rem;color:var(--text-dark)}
.user-info .urole{font-size:.72rem;color:var(--text-soft)}
.content{flex:1;overflow-y:auto;padding:28px 28px 40px}
.page-header{margin-bottom:24px}
.page-header h1{font-family:'Nunito',sans-serif;font-size:1.6rem;font-weight:800;color:var(--text-dark);display:flex;align-items:center;gap:10px}
.page-header p{color:var(--text-mid);margin-top:4px;font-size:.9rem}
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px}
.stat-card{background:var(--white);border-radius:var(--radius);padding:20px;box-shadow:var(--shadow);display:flex;flex-direction:column;gap:6px;transition:box-shadow .2s,transform .2s;cursor:pointer}
.stat-card:hover{box-shadow:var(--shadow-md);transform:translateY(-2px)}
.stat-top{display:flex;align-items:center;gap:14px}
.stat-icon{width:50px;height:50px;border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.stat-texts{flex:1}
.stat-label{font-size:.8rem;color:var(--text-mid);font-weight:600}
.stat-value{font-family:'Nunito',sans-serif;font-size:2rem;font-weight:900;color:var(--text-dark);line-height:1.1}
.stat-footer{display:flex;align-items:center;justify-content:space-between;padding-top:12px;border-top:1px solid var(--border);font-size:.8rem;font-weight:600;color:var(--blue)}
.stat-footer span{color:var(--text-soft)}
.stat-card.urgencia .stat-footer{color:var(--red)}
.stat-card.registrar .stat-footer{color:var(--orange)}
.bottom-grid{display:grid;grid-template-columns:1fr 280px 260px;gap:20px;margin-bottom:24px}
.card{background:var(--white);border-radius:var(--radius);box-shadow:var(--shadow);padding:20px}
.card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}
.card-header h2{font-size:.95rem;font-weight:700;color:var(--text-dark)}
.link-blue{color:var(--blue);font-size:.8rem;font-weight:700;text-decoration:none}
.link-blue:hover{text-decoration:underline}
.ver-todas-btn{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;margin-top:14px;padding:11px;border:1.5px solid var(--blue);border-radius:var(--radius-sm);color:var(--blue);font-weight:700;font-size:.85rem;text-decoration:none;transition:background .15s}
.ver-todas-btn:hover{background:var(--blue-light)}
.cal-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
.cal-month{font-weight:700;font-size:.9rem;color:var(--text-dark)}
.cal-nav{background:none;border:none;cursor:pointer;color:var(--text-mid);display:flex;padding:4px;border-radius:6px;transition:background .15s}
.cal-nav:hover{background:var(--bg);color:var(--blue)}
.cal-grid{display:grid;grid-template-columns:repeat(7,1fr);gap:2px}
.cal-day-name{text-align:center;font-size:.72rem;font-weight:700;color:var(--text-soft);padding:4px 0 6px}
.cal-day{text-align:center;padding:5px 2px;font-size:.8rem;font-weight:600;color:var(--text-mid);border-radius:50%;cursor:pointer;transition:background .15s,color .15s;aspect-ratio:1;display:flex;align-items:center;justify-content:center}
.cal-day:hover{background:var(--blue-light);color:var(--blue)}
.cal-day.hoy{background:var(--blue);color:#fff;font-weight:800}
.cal-day.otro-mes{color:#d1d5db}
.cal-day.con-cita{position:relative}
.cal-day.con-cita::after{content:'';position:absolute;bottom:2px;left:50%;transform:translateX(-50%);width:4px;height:4px;border-radius:50%;background:var(--blue)}
.cal-day.hoy.con-cita::after{background:#fff}
.actividad-item{display:flex;align-items:flex-start;gap:12px;padding:10px 0;border-bottom:1px solid var(--border)}
.actividad-item:last-child{border-bottom:none}
.act-icon{width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.act-info{flex:1}
.act-titulo{font-weight:700;font-size:.83rem;color:var(--text-dark)}
.act-detalle{font-size:.75rem;color:var(--text-soft);margin-top:2px}
.act-tiempo{font-size:.72rem;color:var(--text-soft);white-space:nowrap}
.accesos-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:14px}
.acceso-btn{display:flex;flex-direction:column;align-items:center;gap:8px;padding:16px 10px;background:var(--white);border-radius:var(--radius);text-decoration:none;box-shadow:var(--shadow);transition:box-shadow .2s,transform .2s;cursor:pointer;border:none;font-family:inherit}
.acceso-btn:hover{box-shadow:var(--shadow-md);transform:translateY(-2px)}
.acceso-icon{width:46px;height:46px;border-radius:var(--radius-sm);display:flex;align-items:center;justify-content:center}
.acceso-label{font-size:.78rem;font-weight:700;color:var(--text-dark);text-align:center}
.profile-dropdown{display:none;position:absolute;top:calc(100% + 8px);right:0;min-width:210px;background:var(--white);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow-md);z-index:100;overflow:hidden}
.profile-dropdown.open{display:block}
.profile-dd-header{padding:14px 16px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:12px}
.profile-dd-avatar{width:40px;height:40px;border-radius:50%;background:var(--blue-light);display:flex;align-items:center;justify-content:center;color:var(--blue);font-weight:800;font-size:1rem;flex-shrink:0}
.profile-dd-name{font-weight:700;font-size:.88rem;color:var(--text-dark)}
.profile-dd-role{font-size:.75rem;color:var(--white);background:var(--blue);border-radius:50px;padding:2px 9px;display:inline-block;margin-top:3px;font-weight:600}
.profile-dd-body{padding:8px}
.profile-dd-btn{display:flex;align-items:center;gap:10px;width:100%;padding:10px 12px;border:none;background:none;border-radius:var(--radius-sm);cursor:pointer;font-family:inherit;font-size:.85rem;font-weight:600;color:var(--red);transition:background .15s}
.profile-dd-btn:hover{background:var(--red-light)}
.modal-overlay{display:none;position:fixed;inset:0;z-index:1000;background:rgba(17,24,39,.55);backdrop-filter:blur(3px);align-items:center;justify-content:center;padding:20px}
.modal-overlay.open{display:flex}
.modal{background:var(--white);border-radius:16px;box-shadow:var(--shadow-lg);width:100%;max-width:540px;max-height:90vh;overflow:hidden;display:flex;flex-direction:column;animation:slideUp .25s ease}
@keyframes slideUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
.modal-header{display:flex;align-items:center;justify-content:space-between;padding:20px 24px 16px;border-bottom:1px solid var(--border);flex-shrink:0}
.modal-header h2{font-family:'Nunito',sans-serif;font-size:1.1rem;font-weight:800;color:var(--text-dark);display:flex;align-items:center;gap:8px}
.modal-close{background:none;border:none;cursor:pointer;color:var(--text-soft);display:flex;padding:4px;border-radius:6px;transition:all .15s}
.modal-close:hover{background:var(--bg);color:var(--red)}
.modal-body{padding:24px;overflow-y:auto;flex:1}
.modal-footer{padding:16px 24px;border-top:1px solid var(--border);display:flex;gap:10px;justify-content:flex-end;flex-shrink:0}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px}
.form-row.full{grid-template-columns:1fr}
.form-group{display:flex;flex-direction:column;gap:5px}
.form-group label{font-size:.8rem;font-weight:700;color:var(--text-mid)}
.form-group input,.form-group select,.form-group textarea{padding:9px 12px;border-radius:var(--radius-sm);border:1.5px solid var(--border);background:var(--white);font-family:inherit;font-size:.88rem;color:var(--text-dark);outline:none;transition:border-color .2s}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus{border-color:var(--blue)}
.form-group textarea{resize:vertical;min-height:72px}
.btn{display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:var(--radius-sm);font-family:inherit;font-size:.88rem;font-weight:700;cursor:pointer;border:none;transition:all .15s}
.btn-primary{background:var(--blue);color:#fff}.btn-primary:hover{background:var(--blue-dark)}
.btn-ghost{background:transparent;color:var(--text-mid);border:1.5px solid var(--border)}.btn-ghost:hover{background:var(--bg)}
#logout-overlay{display:none;position:fixed;inset:0;z-index:9999;background:rgba(255,255,255,.97);flex-direction:column;align-items:center;justify-content:center;gap:18px}
#logout-overlay.active{display:flex}
.logout-spinner{width:48px;height:48px;border:4px solid var(--border);border-top-color:var(--blue);border-radius:50%;animation:spin .8s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}
.logout-msg{font-family:'Nunito',sans-serif;font-size:1.05rem;font-weight:700;color:var(--text-dark)}
.logout-sub{font-size:.8rem;color:var(--text-soft);margin-top:-10px}
.empty-state{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;padding:32px 16px;color:var(--text-soft);text-align:center}
.empty-state svg{opacity:.35}
.empty-state p{font-size:.82rem;font-weight:600}
.dash-footer{text-align:center;padding:16px;font-size:.78rem;color:var(--text-soft);border-top:1px solid var(--border);background:var(--white);flex-shrink:0}
@media(max-width:1200px){.stats-row{grid-template-columns:repeat(2,1fr)}.bottom-grid{grid-template-columns:1fr 1fr}.bottom-grid .actividad-card{grid-column:span 2}.accesos-grid{grid-template-columns:repeat(3,1fr)}}
@media(max-width:900px){:root{--sidebar-w:60px}.sidebar-brand .brand-texts,.sidebar-nav a span,.help-btn .help-texts{display:none}.sidebar-nav a{justify-content:center;padding:10px}.bottom-grid{grid-template-columns:1fr}.bottom-grid .actividad-card{grid-column:span 1}}
@media(max-width:600px){.stats-row{grid-template-columns:1fr 1fr}.accesos-grid{grid-template-columns:repeat(2,1fr)}.content{padding:16px}}
</style>
</head>
<body>
<div class="app">

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-logo-sm">
            <img src="<?php echo e(asset('assets/img/logo.png')); ?>" alt="Logo Clínica Bienestar">
        </div>
        <div class="brand-texts">
            <span class="t1">Clínica</span>
            <span class="t2">Bienestar</span>
        </div>
    </div>
    <nav class="sidebar-nav">
        <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($item['href']); ?>" class="<?php echo e($item['id'] === 'inicio' ? 'active' : ''); ?>">
            <?php echo icon($item['icono'], 18); ?>

            <span><?php echo e($item['label']); ?></span>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>
    <div class="sidebar-help">
        <div class="help-btn">
            <?php echo icon('help', 18); ?>

            <div class="help-texts">
                <span>¿Necesitas ayuda?</span>
                <span class="help-sub">Soporte técnico</span>
            </div>
            <?php echo icon('chevron-d', 14); ?>

        </div>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <button class="topbar-menu-btn"><?php echo icon('menu', 20); ?></button>
        <div class="topbar-spacer"></div>
        <div class="topbar-actions">
            <button class="icon-btn">
                <?php echo icon('bell', 20); ?>

                <span class="badge">3</span>
            </button>
            <button class="icon-btn"><?php echo icon('chat', 20); ?></button>
            <div class="user-chip-wrap">
                <div class="user-chip" id="profileChip">
                    <div class="user-avatar"><?php echo e(mb_strtoupper(mb_substr($nombre, 0, 1))); ?></div>
                    <div class="user-info">
                        <span class="uname"><?php echo e($nombre); ?></span>
                        <span class="urole"><?php echo e($info['label']); ?></span>
                    </div>
                    <?php echo icon('chevron-d', 14); ?>

                </div>
                <div class="profile-dropdown" id="profileDropdown">
                    <div class="profile-dd-header">
                        <div class="profile-dd-avatar"><?php echo e(mb_strtoupper(mb_substr($nombre, 0, 1))); ?></div>
                        <div>
                            <div class="profile-dd-name"><?php echo e($nombre); ?></div>
                            <span class="profile-dd-role"><?php echo e($info['label']); ?></span>
                        </div>
                    </div>
                    <div class="profile-dd-body">
                        <a href="<?php echo e(route('logout')); ?>" class="profile-dd-btn">
                            <?php echo icon('logout', 16); ?> Cerrar sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="content">
        <div class="page-header">
            <h1><?php echo e($saludo); ?>, <?php echo e($nombre); ?>! <span><?php echo e($emoji_saludo); ?></span></h1>
            <p>Aquí tienes un resumen de tu actividad de hoy.</p>
        </div>

        <div class="stats-row">
            <div class="stat-card" onclick="window.location='<?php echo e(route('citas')); ?>?fecha=hoy'" style="cursor:pointer">
                <div class="stat-top">
                    <div class="stat-icon" style="background:#eef2ff;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#1a56db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <div class="stat-texts">
                        <div class="stat-label">Pacientes hoy</div>
                        <div class="stat-value"><?php echo e($citas_hoy); ?></div>
                    </div>
                </div>
                <div class="stat-footer"><span>citas para hoy</span><?php echo icon('chevron-r', 16); ?></div>
            </div>
            <div class="stat-card" onclick="window.location='<?php echo e(route('citas')); ?>?estado=proximas'" style="cursor:pointer">
                <div class="stat-top">
                    <div class="stat-icon" style="background:#ecfdf5;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="stat-texts">
                        <div class="stat-label">Próximas citas</div>
                        <div class="stat-value"><?php echo e($citas_proximas); ?></div>
                    </div>
                </div>
                <div class="stat-footer" style="color:var(--green)"><span>de mañana en adelante</span><?php echo icon('chevron-r', 16); ?></div>
            </div>
            <div class="stat-card urgencia" onclick="window.location='<?php echo e(route('citas')); ?>?tipo=urgencia'" style="cursor:pointer">
                <div class="stat-top">
                    <div class="stat-icon" style="background:#fef2f2;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <div class="stat-texts">
                        <div class="stat-label">Emergencias</div>
                        <div class="stat-value"><?php echo e($emergencias); ?></div>
                    </div>
                </div>
                <div class="stat-footer"><span>registradas</span><?php echo icon('chevron-r', 16); ?></div>
            </div>
            <div class="stat-card registrar" onclick="window.location='<?php echo e(route('pacientes')); ?>'" style="cursor:pointer">
                <div class="stat-top">
                    <div class="stat-icon" style="background:#fffbeb;">
                        <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                    </div>
                    <div class="stat-texts">
                        <div class="stat-label">Total pacientes</div>
                        <div class="stat-value"><?php echo e($total_pacientes); ?></div>
                    </div>
                </div>
                <div class="stat-footer"><span>registrados</span><?php echo icon('chevron-r', 16); ?></div>
            </div>
        </div>

        <div class="bottom-grid">
            <div class="card">
                <div class="card-header">
                    <h2>📅 Agenda de hoy</h2>
                    <a href="<?php echo e(route('citas')); ?>" class="link-blue">Ver agenda completa</a>
                </div>
                <?php if(count($agenda_hoy) === 0): ?>
                <div class="empty-state">
                    <?php echo icon('calendar', 36); ?>

                    <p>No hay citas agendadas para hoy</p>
                </div>
                <?php else: ?>
                <?php $__currentLoopData = $agenda_hoy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="actividad-item">
                    <div class="act-icon" style="background:#eef2ff;color:#1a56db;"><?php echo icon('clock', 16); ?></div>
                    <div class="act-info">
                        <div class="act-titulo"><?php echo e($cita->pac_nombre); ?> <?php echo e($cita->pac_apellido); ?></div>
                        <div class="act-detalle"><?php echo e($cita->motivo); ?> · <?php echo e($cita->medico); ?></div>
                    </div>
                    <div class="act-tiempo"><?php echo e(substr($cita->hora, 0, 5)); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <a href="<?php echo e(route('citas')); ?>" class="ver-todas-btn"><?php echo icon('calendar', 16); ?> Ver todas las citas</a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2><?php echo icon('calendar', 16); ?> &nbsp;Calendario</h2>
                </div>
                <div class="cal-header">
                    <button class="cal-nav"><?php echo icon('chevron-l', 16); ?></button>
                    <span class="cal-month"><?php echo e($nombre_meses[$mes_actual]); ?> <?php echo e($anio_actual); ?></span>
                    <button class="cal-nav"><?php echo icon('chevron-r', 16); ?></button>
                </div>
                <div class="cal-grid">
                    <?php $__currentLoopData = ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="cal-day-name"><?php echo e($d); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        for ($i = 0; $i < $primer_dia; $i++) {
                            $prev = $dias_en_mes - ($primer_dia - $i - 1);
                            echo '<div class="cal-day otro-mes">'.$prev.'</div>';
                        }
                        for ($d = 1; $d <= $dias_en_mes; $d++) {
                            $c = 'cal-day';
                            if ($d === $dia_actual) $c .= ' hoy';
                            echo '<div class="'.$c.'">'.$d.'</div>';
                        }
                        $total_cal = $primer_dia + $dias_en_mes;
                        $resto = (7 - ($total_cal % 7)) % 7;
                        for ($i = 1; $i <= $resto; $i++) echo '<div class="cal-day otro-mes">'.$i.'</div>';
                    ?>
                </div>
            </div>

            <div class="card actividad-card">
                <div class="card-header"><h2>Actividad reciente</h2></div>
                <?php if(count($actividad_reciente) === 0): ?>
                <div class="empty-state">
                    <?php echo icon('clock', 36); ?>

                    <p>Sin actividad reciente</p>
                </div>
                <?php else: ?>
                <?php $__currentLoopData = $actividad_reciente; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="actividad-item">
                    <div class="act-icon" style="background:#ecfdf5;color:#059669;"><?php echo icon('check', 16); ?></div>
                    <div class="act-info">
                        <div class="act-titulo"><?php echo e($act->pac_nombre); ?> <?php echo e($act->pac_apellido); ?></div>
                        <div class="act-detalle"><?php echo e($act->motivo); ?></div>
                    </div>
                    <div class="act-tiempo"><?php echo e(date('d/m', strtotime($act->fecha))); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="card-header" style="margin-bottom:14px;">
            <h2 style="font-size:.95rem;font-weight:700;">Accesos rápidos</h2>
        </div>
        <div class="accesos-grid">
            <button class="acceso-btn" id="btnAbrirCitaRapida">
                <div class="acceso-icon" style="background:#eef2ff;color:#1a56db;"><?php echo icon('calendar', 22); ?></div>
                <span class="acceso-label">Nueva cita</span>
            </button>
            <button class="acceso-btn" id="btnRegistrarPaciente">
                <div class="acceso-icon" style="background:#ecfdf5;color:#059669;"><?php echo icon('plus-user', 22); ?></div>
                <span class="acceso-label">Registrar paciente</span>
            </button>
            <a href="<?php echo e(route('pacientes')); ?>" class="acceso-btn">
                <div class="acceso-icon" style="background:#ecfeff;color:#0891b2;"><?php echo icon('search', 22); ?></div>
                <span class="acceso-label">Buscar paciente</span>
            </a>
            <button class="acceso-btn" disabled title="Módulo en desarrollo" style="opacity:.45;cursor:not-allowed;">
                <div class="acceso-icon" style="background:#f5f3ff;color:#7c3aed;"><?php echo icon('file-text', 22); ?></div>
                <span class="acceso-label">Receta rápida</span>
            </button>
            <button class="acceso-btn" disabled title="Módulo en desarrollo" style="opacity:.45;cursor:not-allowed;">
                <div class="acceso-icon" style="background:#fffbeb;color:#d97706;"><?php echo icon('note', 22); ?></div>
                <span class="acceso-label">Notas clínicas</span>
            </button>
        </div>
    </div>

    <footer class="dash-footer">
        <?php echo icon('shield', 13); ?> &nbsp;&copy; <?php echo e(date('Y')); ?> Clínica Bienestar. Todos los derechos reservados.
    </footer>
</div>
</div>


<div class="modal-overlay" id="modalCitaRapida">
    <div class="modal">
        <div class="modal-header">
            <h2><?php echo icon('calendar', 18); ?> Nueva Cita Rápida</h2>
            <button class="modal-close" id="cerrarModalCita"><?php echo icon('x', 20); ?></button>
        </div>
        <div class="modal-body">

            <div class="form-row full">
                <div class="form-group">
                    <label>Paciente *</label>
                    <select id="cr_paciente" required>
                        <option value="">— Selecciona un paciente —</option>
                        <?php $__currentLoopData = $pacientes_inicio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($p->dui); ?>"><?php echo e($p->nombre); ?> <?php echo e($p->apellido); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="form-row full">
                <div class="form-group">
                    <label>Médico *</label>
                    <select id="cr_medico" required>
                        <option value="">— Selecciona un médico —</option>
                        <?php $__currentLoopData = $medicos_inicio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($m->dui); ?>"><?php echo e($m->nombre); ?> <?php echo e($m->apellido); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Fecha *</label>
                    <input type="date" id="cr_fecha" value="<?php echo e(date('Y-m-d')); ?>" required>
                </div>
                <div class="form-group">
                    <label>Hora *</label>
                    <input type="time" id="cr_hora" value="08:00" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Tipo</label>
                    <select id="cr_tipo">
                        <option value="consulta">Consulta</option>
                        <option value="control">Control</option>
                        <option value="urgencia">Urgencia</option>
                        <option value="pediatria">Pediatría</option>
                        <option value="general">General</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <select id="cr_estado">
                        <option value="programada">Programada</option>
                        <option value="confirmada">Confirmada</option>
                        <option value="pendiente">Pendiente</option>
                    </select>
                </div>
            </div>
            <div class="form-row full">
                <div class="form-group">
                    <label>Motivo *</label>
                    <textarea id="cr_motivo" placeholder="Describe el motivo de la cita..." rows="3"></textarea>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button class="btn btn-ghost" id="cancelarModalCita">Cancelar</button>
            <button class="btn btn-primary" id="guardarCitaRapida">
                <?php echo icon('check', 16); ?> Guardar cita
            </button>
        </div>
    </div>
</div>

<div id="logout-overlay">
    <div class="logout-spinner"></div>
    <div class="logout-msg">Cerrando sesión...</div>
    <div class="logout-sub">Por favor espere un momento</div>
</div>


<div class="modal-overlay" id="modalRegistrarPaciente">
    <div class="modal">
        <div class="modal-header">
            <h2><?php echo icon('plus-user', 18); ?> Registrar Nuevo Paciente</h2>
            <button class="modal-close" id="cerrarModalPaciente"><?php echo icon('x', 20); ?></button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label>Nombres *</label>
                    <input type="text" id="rp_nombre" placeholder="Nombres del paciente">
                </div>
                <div class="form-group">
                    <label>Apellidos *</label>
                    <input type="text" id="rp_apellido" placeholder="Apellidos del paciente">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>DUI *</label>
                    <input type="text" id="rp_dui" placeholder="00000000-0" maxlength="10">
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="tel" id="rp_telefono" placeholder="0000-0000">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Fecha de nacimiento</label>
                    <input type="date" id="rp_fecha_nacimiento">
                </div>
                <div class="form-group">
                    <label>Edad</label>
                    <input type="number" id="rp_edad" placeholder="Años" min="0" max="120">
                </div>
            </div>
            <div class="form-row full">
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" id="rp_direccion" placeholder="Dirección del paciente">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-ghost" id="cancelarModalPaciente">Cancelar</button>
            <button class="btn btn-primary" id="guardarPacienteRapido">
                <?php echo icon('check', 16); ?> Guardar paciente
            </button>
        </div>
    </div>
</div>

<script>
// Modal cita rápida
const btnAbrir    = document.getElementById('btnAbrirCitaRapida');
const modalCita   = document.getElementById('modalCitaRapida');
const btnCerrar   = document.getElementById('cerrarModalCita');
const btnCancelar = document.getElementById('cancelarModalCita');

function abrirModal() { modalCita.classList.add('open'); document.body.style.overflow = 'hidden'; }
function cerrarModal() { modalCita.classList.remove('open'); document.body.style.overflow = ''; }

btnAbrir.addEventListener('click', abrirModal);
btnCerrar.addEventListener('click', cerrarModal);
btnCancelar.addEventListener('click', cerrarModal);
modalCita.addEventListener('click', function(e) { if (e.target === this) cerrarModal(); });

document.getElementById('guardarCitaRapida').addEventListener('click', async function() {
    const dui_paciente = document.getElementById('cr_paciente').value;
    const dui_medico   = document.getElementById('cr_medico').value;
    const fecha        = document.getElementById('cr_fecha').value;
    const hora         = document.getElementById('cr_hora').value;
    const motivo       = document.getElementById('cr_motivo').value.trim();
    const tipo_cita    = document.getElementById('cr_tipo').value;
    const estado       = document.getElementById('cr_estado').value;

    if (!dui_paciente || !dui_medico || !fecha || !hora || !motivo) {
        alert('Por favor completa todos los campos obligatorios (*).');
        return;
    }

    this.disabled = true;
    this.textContent = 'Guardando...';

    try {
        const response = await fetch('<?php echo e(route("citas.rapida")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({ dui_paciente, dui_medico, fecha, hora, motivo, tipo_cita, estado })
        });

        const data = await response.json();
        if (data.success) {
            cerrarModal();
            // Limpiar campos
            document.getElementById('cr_paciente').value = '';
            document.getElementById('cr_medico').value   = '';
            document.getElementById('cr_motivo').value   = '';
            // Recargar para reflejar nueva cita en las estadísticas
            setTimeout(() => location.reload(), 500);
        } else {
            alert('Error al guardar: ' + (data.message || 'Error desconocido'));
        }
    } catch (error) {
        console.error(error);
        alert('Error de conexión. Intenta de nuevo.');
    } finally {
        this.disabled = false;
        this.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 13.5 4 8.5"/></svg> Guardar cita';
    }
});

// Modal registrar paciente
const modalPac    = document.getElementById('modalRegistrarPaciente');
document.getElementById('btnRegistrarPaciente').addEventListener('click', () => { modalPac.classList.add('open'); document.body.style.overflow='hidden'; });
document.getElementById('cerrarModalPaciente').addEventListener('click', () => { modalPac.classList.remove('open'); document.body.style.overflow=''; });
document.getElementById('cancelarModalPaciente').addEventListener('click', () => { modalPac.classList.remove('open'); document.body.style.overflow=''; });
modalPac.addEventListener('click', function(e) { if (e.target === this) { this.classList.remove('open'); document.body.style.overflow=''; } });

// Auto-calcular edad al cambiar fecha de nacimiento
document.getElementById('rp_fecha_nacimiento').addEventListener('change', function() {
    if (this.value) {
        const hoy = new Date();
        const nac = new Date(this.value);
        let edad = hoy.getFullYear() - nac.getFullYear();
        const m = hoy.getMonth() - nac.getMonth();
        if (m < 0 || (m === 0 && hoy.getDate() < nac.getDate())) edad--;
        document.getElementById('rp_edad').value = edad > 0 ? edad : '';
    }
});

document.getElementById('guardarPacienteRapido').addEventListener('click', async function() {
    const nombre   = document.getElementById('rp_nombre').value.trim();
    const apellido = document.getElementById('rp_apellido').value.trim();
    const dui      = document.getElementById('rp_dui').value.trim();
    const telefono = document.getElementById('rp_telefono').value.trim();
    const edad     = document.getElementById('rp_edad').value;
    const fecha_nacimiento = document.getElementById('rp_fecha_nacimiento').value;
    const direccion = document.getElementById('rp_direccion').value.trim();

    if (!nombre || !apellido || !dui) {
        alert('Por favor completa Nombres, Apellidos y DUI (*).');
        return;
    }

    this.disabled = true;
    this.textContent = 'Guardando...';

    try {
        const response = await fetch('<?php echo e(route("paciente.guardar")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({ nombre, apellido, dui, telefono, edad: edad || null, fecha_nacimiento: fecha_nacimiento || null, direccion })
        });

        const data = await response.json();
        if (data.success) {
            modalPac.classList.remove('open');
            document.body.style.overflow = '';
            ['rp_nombre','rp_apellido','rp_dui','rp_telefono','rp_edad','rp_fecha_nacimiento','rp_direccion'].forEach(id => document.getElementById(id).value = '');
            // Mostrar toast simple
            const t = document.createElement('div');
            t.textContent = 'Paciente registrado correctamente';
            t.style.cssText = 'position:fixed;bottom:24px;right:24px;background:#059669;color:#fff;padding:12px 20px;border-radius:10px;font-weight:600;z-index:9999;box-shadow:0 4px 12px rgba(0,0,0,.18)';
            document.body.appendChild(t);
            setTimeout(() => t.remove(), 3000);
            setTimeout(() => location.reload(), 1200);
        } else {
            alert('Error al guardar: ' + (data.message || 'Error desconocido'));
        }
    } catch (error) {
        console.error(error);
        alert('Error de conexión. Intenta de nuevo.');
    } finally {
        this.disabled = false;
        this.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 13.5 4 8.5"/></svg> Guardar paciente';
    }
});

// Dropdown perfil
const chip     = document.getElementById('profileChip');
const dropdown = document.getElementById('profileDropdown');
chip.addEventListener('click', e => { e.stopPropagation(); dropdown.classList.toggle('open'); });
document.addEventListener('click', () => dropdown.classList.remove('open'));
document.querySelector('.profile-dd-btn').addEventListener('click', function(e) {
    e.preventDefault();
    const dest = this.getAttribute('href');
    dropdown.classList.remove('open');
    document.getElementById('logout-overlay').classList.add('active');
    setTimeout(() => { window.location.href = dest; }, 900);
});
</script>
</body>
</html><?php /**PATH C:\Users\chris\OneDrive\Imágenes\Escritorio\Clinica Medica\clinica\resources\views/inicio.blade.php ENDPATH**/ ?>