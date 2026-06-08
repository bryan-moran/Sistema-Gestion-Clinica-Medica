{{-- resources/views/pacientes.blade.php --}}
@php
    $rol    = session('rol', 'desconocido');
    $nombre = session('usuario', 'Usuario');

    $roles_info = [
        'Administrador' => ['label' => 'Administrador', 'color' => '#1a56db', 'bg' => '#eef2ff'],
        'Médico'        => ['label' => 'Médico',        'color' => '#059669', 'bg' => '#ecfdf5'],
        'Recepcionista' => ['label' => 'Recepcionista', 'color' => '#0891b2', 'bg' => '#ecfeff'],
    ];
    $info = $roles_info[$rol] ?? ['label' => ucfirst($rol), 'color' => '#6b7280', 'bg' => '#f9fafb'];

    $menu = [
        ['id'=>'inicio',       'label'=>'Inicio',       'icono'=>'home',      'href'=>route('inicio')],
        ['id'=>'citas',        'label'=>'Citas',        'icono'=>'calendar',  'href'=>route('citas')],
        ['id'=>'pacientes',    'label'=>'Pacientes',    'icono'=>'users',     'href'=>route('pacientes')],
        ['id'=>'emergencias',  'label'=>'Emergencias',  'icono'=>'alert',     'href'=>route('emergencias')],
        ['id'=>'historiales',  'label'=>'Historiales',  'icono'=>'clipboard', 'href'=>'#'],
        ['id'=>'recetas',      'label'=>'Recetas',      'icono'=>'file-text', 'href'=>'#'],
        ['id'=>'laboratorio',  'label'=>'Laboratorio',  'icono'=>'flask',     'href'=>'#'],
        ['id'=>'facturacion',  'label'=>'Facturación',  'icono'=>'dollar',    'href'=>'#'],
        ['id'=>'reportes',     'label'=>'Reportes',     'icono'=>'bar-chart', 'href'=>'#'],
        ['id'=>'configuracion','label'=>'Configuración','icono'=>'settings',  'href'=>'#'],
    ];

    function svg_icon(string $name): string {
        $icons = [
            'home'      => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>',
            'calendar'  => '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>',
            'users'     => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
            'alert'     => '<path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
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
            'chevron-d' => '<polyline points="6 9 12 15 18 9"/>',
            'menu'      => '<line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/>',
            'help'      => '<circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>',
            'search'    => '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>',
            'plus'      => '<line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>',
            'check'     => '<polyline points="20 6 9 13.5 4 8.5"/>',
            'x'         => '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>',
            'edit'      => '<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>',
            'trash'     => '<polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>',
            'shield'    => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
            'user-plus' => '<path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/>',
        ];
        return $icons[$name] ?? '';
    }

    function icon(string $name, int $size = 20, string $extra = ''): string {
        $d = svg_icon($name);
        return '<svg width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" '.$extra.'>'.$d.'</svg>';
    }

    function getInitialsColor(string $name): string {
        $colors = ['#1a56db', '#059669', '#0891b2', '#7c3aed', '#dc2626', '#d97706'];
        $index = abs(crc32($name)) % count($colors);
        return $colors[$index];
    }
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pacientes – Clínica Bienestar</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{--blue:#1a56db;--blue-dark:#1341b0;--blue-light:#eef2ff;--blue-mid:#3b82f6;--green:#059669;--green-light:#ecfdf5;--orange:#d97706;--orange-light:#fffbeb;--red:#dc2626;--red-light:#fef2f2;--cyan:#0891b2;--cyan-light:#ecfeff;--purple:#7c3aed;--purple-light:#f5f3ff;--text-dark:#111827;--text-mid:#4b5563;--text-soft:#9ca3af;--border:#e5e7eb;--bg:#f3f6fb;--white:#ffffff;--sidebar-w:220px;--topbar-h:64px;--radius:12px;--radius-sm:8px;--shadow:0 2px 12px rgba(0,0,0,.07);--shadow-md:0 4px 20px rgba(0,0,0,.10);--shadow-lg:0 8px 40px rgba(0,0,0,.14)}
html,body{height:100%;font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--text-dark);font-size:14px}
.app{display:flex;height:100vh;overflow:hidden}
.sidebar{width:var(--sidebar-w);background:var(--white);border-right:1px solid var(--border);display:flex;flex-direction:column;flex-shrink:0;height:100vh;overflow-y:auto;position:relative;z-index:10}
.sidebar-brand{display:flex;align-items:center;gap:12px;padding:18px 18px 16px;border-bottom:1px solid var(--border);pointer-events:none;cursor:default}
.brand-logo-sm{width:46px;height:46px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
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
.badge-notif{position:absolute;top:3px;right:3px;background:var(--red);color:#fff;border-radius:50%;width:16px;height:16px;font-size:.65rem;font-weight:800;display:flex;align-items:center;justify-content:center;border:2px solid #fff}
.user-chip-wrap{position:relative}
.user-chip{display:flex;align-items:center;gap:10px;padding:5px 10px 5px 5px;border-radius:50px;border:1px solid var(--border);cursor:pointer;transition:background .15s;margin-left:4px}
.user-chip:hover{background:var(--bg)}
.user-avatar{width:34px;height:34px;border-radius:50%;background:var(--blue-light);display:flex;align-items:center;justify-content:center;color:var(--blue);font-weight:800;font-size:.85rem;flex-shrink:0}
.user-info{display:flex;flex-direction:column;line-height:1.15}
.user-info .uname{font-weight:700;font-size:.85rem;color:var(--text-dark)}
.user-info .urole{font-size:.72rem;color:var(--text-soft)}
.content{flex:1;overflow-y:auto;padding:28px 28px 40px}
.page-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px}
.page-header-left h1{font-family:'Nunito',sans-serif;font-size:1.6rem;font-weight:800;color:var(--text-dark);display:flex;align-items:center;gap:10px}
.page-header-left p{color:var(--text-mid);margin-top:4px;font-size:.9rem}
.page-header-actions{display:flex;gap:10px;flex-wrap:wrap}
.search-wrap{display:flex;align-items:center;gap:8px;background:var(--bg);border:1.5px solid var(--border);border-radius:var(--radius-sm);padding:8px 14px;flex:1;min-width:200px;transition:border-color .2s}
.search-wrap:focus-within{border-color:var(--blue)}
.search-wrap input{border:none;background:transparent;outline:none;font-family:inherit;font-size:.88rem;color:var(--text-dark);width:100%}
.search-wrap input::placeholder{color:var(--text-soft)}
.table-card{background:var(--white);border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden}
.table-card-header{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid var(--border)}
.table-card-header h2{font-size:.95rem;font-weight:700;color:var(--text-dark)}
.table-info{font-size:.8rem;color:var(--text-soft);font-weight:600}
.table-wrap{overflow-x:auto}
table{width:100%;border-collapse:collapse}
thead th{text-align:left;padding:11px 16px;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.04em;color:var(--text-soft);background:var(--bg);border-bottom:1px solid var(--border);white-space:nowrap}
tbody tr{transition:background .1s}
tbody tr:hover{background:#f8faff}
tbody tr:not(:last-child){border-bottom:1px solid var(--border)}
tbody td{padding:13px 16px;font-size:.875rem;color:var(--text-dark);vertical-align:middle}
.td-paciente{display:flex;align-items:center;gap:10px}
.td-avatar{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.85rem;flex-shrink:0}
.td-nombre{font-weight:700;font-size:.88rem}
.td-dui{font-size:.75rem;color:var(--text-soft);margin-top:1px}
.td-actions{display:flex;align-items:center;gap:6px}
.action-btn{width:30px;height:30px;border-radius:6px;border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s}
.action-btn.edit{background:var(--orange-light);color:var(--orange)}
.action-btn.del{background:var(--red-light);color:var(--red)}
.action-btn:hover{opacity:.8;transform:scale(1.08)}
.modal-overlay{display:none;position:fixed;inset:0;z-index:1000;background:rgba(17,24,39,.55);backdrop-filter:blur(3px);align-items:center;justify-content:center;padding:20px}
.modal-overlay.open{display:flex}
.modal{background:var(--white);border-radius:16px;box-shadow:var(--shadow-lg);width:100%;max-width:550px;max-height:90vh;overflow:hidden;display:flex;flex-direction:column;animation:slideUp .25s ease}
@keyframes slideUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
.modal-header{display:flex;align-items:center;justify-content:space-between;padding:20px 24px 16px;border-bottom:1px solid var(--border);flex-shrink:0}
.modal-header h2{font-family:'Nunito',sans-serif;font-size:1.15rem;font-weight:800;color:var(--text-dark);display:flex;align-items:center;gap:8px}
.modal-close{background:none;border:none;cursor:pointer;color:var(--text-soft);display:flex;padding:4px;border-radius:6px;transition:all .15s}
.modal-close:hover{background:var(--bg);color:var(--red)}
.modal-body{padding:24px;overflow-y:auto;flex:1}
.modal-footer{padding:16px 24px;border-top:1px solid var(--border);display:flex;gap:10px;justify-content:flex-end;flex-shrink:0}
.btn{display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:var(--radius-sm);font-family:inherit;font-size:.88rem;font-weight:700;cursor:pointer;border:none;transition:all .15s;text-decoration:none}
.btn-primary{background:var(--blue);color:#fff}.btn-primary:hover{background:var(--blue-dark)}
.btn-danger{background:var(--red);color:#fff}.btn-danger:hover{background:#b91c1c}
.btn-outline{background:var(--white);color:var(--blue);border:1.5px solid var(--blue)}.btn-outline:hover{background:var(--blue-light)}
.btn-ghost{background:transparent;color:var(--text-mid);border:1.5px solid var(--border)}.btn-ghost:hover{background:var(--bg);color:var(--text-dark)}
.form-group{display:flex;flex-direction:column;gap:6px;margin-bottom:14px}
.form-group label{font-size:.8rem;font-weight:700;color:var(--text-mid)}
.form-group input,.form-group select,.form-group textarea{padding:9px 13px;border-radius:var(--radius-sm);border:1.5px solid var(--border);background:var(--white);font-family:inherit;font-size:.88rem;color:var(--text-dark);outline:none;transition:border-color .2s}
.form-group input:focus,.form-group select:focus,.form-group textarea:focus{border-color:var(--blue)}
.form-group input.input-error{border-color:var(--red)!important}
.form-group textarea{resize:vertical;min-height:60px}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:8px}
.form-row.full{grid-template-columns:1fr}
.field-error{font-size:.75rem;color:var(--red);font-weight:600;margin-top:3px;display:none}
.field-error.show{display:block}
.toast{position:fixed;bottom:28px;right:28px;z-index:2000;display:flex;align-items:center;gap:12px;padding:14px 20px;border-radius:var(--radius);background:var(--text-dark);color:#fff;box-shadow:var(--shadow-lg);font-size:.88rem;font-weight:600;transform:translateY(20px);opacity:0;transition:all .3s ease;pointer-events:none}
.toast.show{transform:translateY(0);opacity:1}
.toast.success{background:var(--green)}
.toast.error{background:var(--red)}
.profile-dropdown{display:none;position:absolute;top:calc(100% + 8px);right:0;min-width:210px;background:var(--white);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow-md);z-index:100;overflow:hidden}
.profile-dropdown.open{display:block}
.profile-dd-header{padding:14px 16px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:12px}
.profile-dd-avatar{width:40px;height:40px;border-radius:50%;background:var(--blue-light);display:flex;align-items:center;justify-content:center;color:var(--blue);font-weight:800;font-size:1rem;flex-shrink:0}
.profile-dd-name{font-weight:700;font-size:.88rem;color:var(--text-dark)}
.profile-dd-role{font-size:.75rem;color:var(--white);background:var(--blue);border-radius:50px;padding:2px 9px;display:inline-block;margin-top:3px;font-weight:600}
.profile-dd-body{padding:8px}
.profile-dd-btn{display:flex;align-items:center;gap:10px;width:100%;padding:10px 12px;border:none;background:none;border-radius:var(--radius-sm);cursor:pointer;font-family:inherit;font-size:.85rem;font-weight:600;color:var(--red);transition:background .15s}
.profile-dd-btn:hover{background:var(--red-light)}
.dash-footer{text-align:center;padding:16px;font-size:.78rem;color:var(--text-soft);border-top:1px solid var(--border);background:var(--white);flex-shrink:0}
.modal-confirm{max-width:420px}
.confirm-body{text-align:center;padding:8px 0}
.confirm-icon{width:56px;height:56px;border-radius:50%;background:var(--red-light);color:var(--red);display:flex;align-items:center;justify-content:center;margin:0 auto 16px}
.confirm-title{font-family:'Nunito',sans-serif;font-weight:800;font-size:1.1rem;color:var(--text-dark);margin-bottom:8px}
.confirm-desc{font-size:.87rem;color:var(--text-mid);line-height:1.6}
@media(max-width:900px){:root{--sidebar-w:60px}.brand-texts,.sidebar-nav a span,.help-btn .help-texts{display:none}.sidebar-nav a{justify-content:center;padding:10px}}
@media(max-width:600px){.content{padding:16px}}
</style>
</head>
<body>
<div class="app">

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-logo-sm"><img src="{{ asset('assets/img/logo.png') }}" alt="Logo"></div>
        <div class="brand-texts"><span class="t1">Clínica</span><span class="t2">Bienestar</span></div>
    </div>
    <nav class="sidebar-nav">
        @foreach ($menu as $item)
        <a href="{{ $item['href'] }}" class="{{ $item['id'] === 'pacientes' ? 'active' : '' }}">
            {!! icon($item['icono'], 18) !!}<span>{{ $item['label'] }}</span>
        </a>
        @endforeach
    </nav>
    <div class="sidebar-help">
        <div class="help-btn">
            {!! icon('help', 18) !!}
            <div class="help-texts"><span>¿Necesitas ayuda?</span><span class="help-sub">Soporte técnico</span></div>
        </div>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <button class="topbar-menu-btn">{!! icon('menu', 20) !!}</button>
        <div class="topbar-spacer"></div>
        <div class="topbar-actions">
            <button class="icon-btn">{!! icon('bell', 20) !!}<span class="badge-notif">3</span></button>
            <button class="icon-btn">{!! icon('chat', 20) !!}</button>
            <div class="user-chip-wrap">
                <div class="user-chip" id="profileChip">
                    <div class="user-avatar">{{ mb_strtoupper(mb_substr($nombre, 0, 1)) }}</div>
                    <div class="user-info">
                        <span class="uname">{{ $nombre }}</span>
                        <span class="urole">{{ $info['label'] }}</span>
                    </div>
                    {!! icon('chevron-d', 14) !!}
                </div>
                <div class="profile-dropdown" id="profileDropdown">
                    <div class="profile-dd-header">
                        <div class="profile-dd-avatar">{{ mb_strtoupper(mb_substr($nombre, 0, 1)) }}</div>
                        <div>
                            <div class="profile-dd-name">{{ $nombre }}</div>
                            <span class="profile-dd-role">{{ $info['label'] }}</span>
                        </div>
                    </div>
                    <div class="profile-dd-body">
                        <a href="{{ route('logout') }}" class="profile-dd-btn">{!! icon('logout', 16) !!} Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="content">
        <div class="page-header">
            <div class="page-header-left">
                <h1>{!! icon('users', 24) !!} Pacientes</h1>
                <p>Listado de pacientes registrados.</p>
            </div>
            <div class="page-header-actions">
                <button class="btn btn-primary" id="btnAgregarPaciente">{!! icon('user-plus', 16) !!} Añadir Paciente</button>
            </div>
        </div>

        <div class="search-wrap" style="margin-bottom:18px;">
            {!! icon('search', 16, 'style="color:var(--text-soft);flex-shrink:0;"') !!}
            <input type="text" id="searchInput" placeholder="Buscar paciente por nombre, DUI o teléfono..." autocomplete="off">
        </div>

        <div class="table-card">
            <div class="table-card-header">
                <h2>Lista de pacientes registrados</h2>
                <span class="table-info" id="tableInfo">Mostrando {{ count($pacientes) }} pacientes</span>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Paciente</th><th>DUI</th><th>Teléfono</th><th>Edad</th><th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="pacientesBody">
                        @foreach ($pacientes as $paciente)
                        <tr data-nombre="{{ strtolower($paciente->nombre.' '.$paciente->apellido) }}" data-dui="{{ $paciente->dui }}" data-telefono="{{ $paciente->telefono }}">
                            <td>
                                <div class="td-paciente">
                                    <div class="td-avatar" style="background:{{ getInitialsColor($paciente->nombre) }}20;color:{{ getInitialsColor($paciente->nombre) }};">
                                        {{ strtoupper(substr($paciente->nombre, 0, 1)) }}{{ strtoupper(substr($paciente->apellido, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="td-nombre">{{ $paciente->nombre }} {{ $paciente->apellido }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $paciente->dui }}</td>
                            <td>{{ $paciente->telefono ?? 'N/A' }}</td>
                            <td>{{ $paciente->edad ?? 'N/A' }} años</td>
                            <td>
                                <div class="td-actions">
                                    <button class="action-btn edit" onclick="verPaciente('{{ $paciente->dui }}')" title="Editar">{!! icon('edit',14) !!}</button>
                                    <button class="action-btn del" onclick="confirmarEliminar('{{ $paciente->dui }}','{{ $paciente->nombre }} {{ $paciente->apellido }}')" title="Eliminar">{!! icon('trash',14) !!}</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div id="emptyState" style="display:none; padding:60px;text-align:center;color:var(--text-soft);">
                    {!! icon('users',48) !!}
                    <h3 style="margin-top:12px;font-weight:700;">No se encontraron pacientes</h3>
                    <p style="font-size:.82rem;margin-top:6px;">Intenta con otros términos de búsqueda</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="dash-footer">{!! icon('shield',13) !!} &nbsp;&copy; {{ date('Y') }} Clínica Bienestar. Todos los derechos reservados.</footer>
</div>
</div>

{{-- MODAL AGREGAR PACIENTE --}}
<div class="modal-overlay" id="modalAgregarPaciente">
    <div class="modal">
        <div class="modal-header">
            <h2>{!! icon('user-plus',18) !!} Añadir Nuevo Paciente</h2>
            <button class="modal-close" id="closeModalAgregar">{!! icon('x',20) !!}</button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label>Nombres *</label>
                    <input type="text" id="add_nombre" placeholder="Nombres del paciente">
                    <span class="field-error" id="err_add_nombre"></span>
                </div>
                <div class="form-group">
                    <label>Apellidos *</label>
                    <input type="text" id="add_apellido" placeholder="Apellidos del paciente">
                    <span class="field-error" id="err_add_apellido"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>DUI *</label>
                    <input type="text" id="add_dui" placeholder="12345678-9" maxlength="10">
                    <span class="field-error" id="err_add_dui"></span>
                </div>
                <div class="form-group">
                    <label>Teléfono (opcional)</label>
                    <input type="text" id="add_telefono" placeholder="0000-0000" maxlength="9">
                    <span class="field-error" id="err_add_telefono"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Edad</label>
                    <input type="number" id="add_edad" placeholder="Edad" min="0" max="120">
                </div>
                <div class="form-group">
                    <label>Fecha de nacimiento</label>
                    <input type="date" id="add_fecha_nacimiento">
                </div>
            </div>
            <div class="form-row full">
                <div class="form-group">
                    <label>Dirección</label>
                    <textarea id="add_direccion" rows="2" placeholder="Dirección completa (opcional)"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-ghost" id="cancelModalAgregar">Cancelar</button>
            <button class="btn btn-primary" id="guardarNuevoPaciente">{!! icon('check',16) !!} Guardar paciente</button>
        </div>
    </div>
</div>

{{-- MODAL VER/EDITAR PACIENTE --}}
<div class="modal-overlay" id="modalPaciente">
    <div class="modal">
        <div class="modal-header">
            <h2>{!! icon('edit',18) !!} Editar Paciente</h2>
            <button class="modal-close" id="closeModalPaciente">{!! icon('x',20) !!}</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="edit_dui_original">
            <div class="form-row">
                <div class="form-group">
                    <label>Nombres *</label>
                    <input type="text" id="edit_nombre" placeholder="Nombres">
                    <span class="field-error" id="err_edit_nombre"></span>
                </div>
                <div class="form-group">
                    <label>Apellidos *</label>
                    <input type="text" id="edit_apellido" placeholder="Apellidos">
                    <span class="field-error" id="err_edit_apellido"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>DUI *</label>
                    <input type="text" id="edit_dui" placeholder="12345678-9" maxlength="10">
                    <span class="field-error" id="err_edit_dui"></span>
                </div>
                <div class="form-group">
                    <label>Teléfono (opcional)</label>
                    <input type="text" id="edit_telefono" placeholder="0000-0000" maxlength="9">
                    <span class="field-error" id="err_edit_telefono"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Edad</label>
                    <input type="number" id="edit_edad" placeholder="Edad" min="0" max="120">
                </div>
                <div class="form-group">
                    <label>Fecha de nacimiento</label>
                    <input type="date" id="edit_fecha_nacimiento">
                </div>
            </div>
            <div class="form-row full">
                <div class="form-group">
                    <label>Dirección</label>
                    <textarea id="edit_direccion" rows="2" placeholder="Dirección completa"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-ghost" id="cancelModalPaciente">Cancelar</button>
            <button class="btn btn-primary" id="guardarPaciente">{!! icon('check',16) !!} Guardar cambios</button>
        </div>
    </div>
</div>

{{-- MODAL CONFIRMAR ELIMINAR --}}
<div class="modal-overlay" id="modalConfirmarEliminar">
    <div class="modal modal-confirm">
        <div class="modal-body">
            <div class="confirm-body">
                <div class="confirm-icon">{!! icon('trash',26) !!}</div>
                <div class="confirm-title">¿Eliminar paciente?</div>
                <p class="confirm-desc" id="confirmDesc">Esta acción no se puede deshacer.</p>
            </div>
        </div>
        <div class="modal-footer" style="justify-content:center;">
            <button class="btn btn-ghost" id="cancelEliminar">Cancelar</button>
            <button class="btn btn-danger" id="confirmarEliminarBtn">{!! icon('trash',16) !!} Eliminar</button>
        </div>
    </div>
</div>

<div class="toast" id="toast"></div>

<script>
let pacienteActual = null;
let duiAEliminar = null;

// ───────────────────────────── UTILIDADES ─────────────────────────────
function abrirModal(id) { document.getElementById(id).classList.add('open'); document.body.style.overflow = 'hidden'; }
function cerrarModal(id) { document.getElementById(id).classList.remove('open'); document.body.style.overflow = ''; }

let toastTimeout;
function showToast(msg, type = '') {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.className = 'toast show' + (type ? ' ' + type : '');
    clearTimeout(toastTimeout);
    toastTimeout = setTimeout(() => t.classList.remove('show'), 3400);
}

function setError(id, msg) {
    const el = document.getElementById(id);
    if (el) { el.textContent = msg; el.classList.toggle('show', !!msg); }
}
function clearErrors(...ids) { ids.forEach(id => setError(id, '')); }

// Formato DUI automático mientras escribe
function formatearDUI(input) {
    input.addEventListener('input', function() {
        let val = this.value.replace(/[^0-9]/g, '');
        if (val.length > 8) val = val.slice(0,8) + '-' + val.slice(8,9);
        this.value = val;
    });
}

// Solo letras y espacios en campos de nombre
function soloLetras(input, errId) {
    input.addEventListener('input', function() {
        const regex = /[^a-záéíóúüñÁÉÍÓÚÜÑ\s]/gi;
        if (regex.test(this.value)) {
            setError(errId, 'El nombre y apellido solo pueden contener letras y espacios.');
            this.classList.add('input-error');
        } else {
            setError(errId, '');
            this.classList.remove('input-error');
        }
    });
}

// Configurar inputs al cargar
document.addEventListener('DOMContentLoaded', function() {
    formatearDUI(document.getElementById('add_dui'));
    formatearDUI(document.getElementById('edit_dui'));
    soloLetras(document.getElementById('add_nombre'), 'err_add_nombre');
    soloLetras(document.getElementById('add_apellido'), 'err_add_apellido');
    soloLetras(document.getElementById('edit_nombre'), 'err_edit_nombre');
    soloLetras(document.getElementById('edit_apellido'), 'err_edit_apellido');
});

// ───────────────────────────── AÑADIR PACIENTE ─────────────────────────────
document.getElementById('btnAgregarPaciente').addEventListener('click', function() {
    document.getElementById('add_nombre').value = '';
    document.getElementById('add_apellido').value = '';
    document.getElementById('add_dui').value = '';
    document.getElementById('add_telefono').value = '';
    document.getElementById('add_edad').value = '';
    document.getElementById('add_fecha_nacimiento').value = '';
    document.getElementById('add_direccion').value = '';
    clearErrors('err_add_nombre','err_add_apellido','err_add_dui','err_add_telefono');
    abrirModal('modalAgregarPaciente');
});

document.getElementById('guardarNuevoPaciente').addEventListener('click', function() {
    clearErrors('err_add_nombre','err_add_apellido','err_add_dui','err_add_telefono');

    const formData = {
        nombre:           document.getElementById('add_nombre').value.trim(),
        apellido:         document.getElementById('add_apellido').value.trim(),
        dui:              document.getElementById('add_dui').value.trim(),
        telefono:         document.getElementById('add_telefono').value.trim(),
        edad:             document.getElementById('add_edad').value,
        fecha_nacimiento: document.getElementById('add_fecha_nacimiento').value,
        direccion:        document.getElementById('add_direccion').value.trim(),
    };

    fetch('/paciente/guardar', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify(formData)
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            showToast('Paciente registrado correctamente.', 'success');
            cerrarModal('modalAgregarPaciente');
            setTimeout(() => location.reload(), 1000);
        } else {
            const msg = data.message || 'Error al guardar.';
            // Mostrar error en el campo correspondiente
            if (msg.includes('DUI es obligatorio')) setError('err_add_dui', msg);
            else if (msg.includes('DUI válido'))     setError('err_add_dui', msg);
            else if (msg.includes('ya existe') || msg.includes('DUI')) setError('err_add_dui', msg);
            else if (msg.includes('teléfono'))       setError('err_add_telefono', msg);
            else if (msg.includes('nombre') || msg.includes('apellido')) { setError('err_add_nombre', msg); setError('err_add_apellido', msg); }
            else showToast(msg, 'error');
        }
    })
    .catch(() => showToast('Error de conexión.', 'error'));
});

document.getElementById('closeModalAgregar').addEventListener('click', () => cerrarModal('modalAgregarPaciente'));
document.getElementById('cancelModalAgregar').addEventListener('click', () => cerrarModal('modalAgregarPaciente'));
document.getElementById('modalAgregarPaciente').addEventListener('click', function(e) { if (e.target === this) cerrarModal('modalAgregarPaciente'); });

// ───────────────────────────── EDITAR PACIENTE ─────────────────────────────
function verPaciente(dui) {
    fetch(`/paciente/${dui}/datos`)
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                pacienteActual = data.paciente;
                document.getElementById('edit_dui_original').value = pacienteActual.dui;
                document.getElementById('edit_nombre').value = pacienteActual.nombre || '';
                document.getElementById('edit_apellido').value = pacienteActual.apellido || '';
                document.getElementById('edit_dui').value = pacienteActual.dui || '';
                document.getElementById('edit_telefono').value = pacienteActual.telefono || '';
                document.getElementById('edit_edad').value = pacienteActual.edad || '';
                document.getElementById('edit_fecha_nacimiento').value = pacienteActual.fecha_nacimiento || '';
                document.getElementById('edit_direccion').value = pacienteActual.direccion || '';
                clearErrors('err_edit_nombre','err_edit_apellido','err_edit_dui','err_edit_telefono');
                abrirModal('modalPaciente');
            } else {
                showToast('Error al cargar los datos del paciente.', 'error');
            }
        })
        .catch(() => showToast('Error de conexión.', 'error'));
}

document.getElementById('guardarPaciente').addEventListener('click', function() {
    clearErrors('err_edit_nombre','err_edit_apellido','err_edit_dui','err_edit_telefono');

    const formData = {
        dui_original:     document.getElementById('edit_dui_original').value,
        nombre:           document.getElementById('edit_nombre').value.trim(),
        apellido:         document.getElementById('edit_apellido').value.trim(),
        dui:              document.getElementById('edit_dui').value.trim(),
        telefono:         document.getElementById('edit_telefono').value.trim(),
        edad:             document.getElementById('edit_edad').value,
        fecha_nacimiento: document.getElementById('edit_fecha_nacimiento').value,
        direccion:        document.getElementById('edit_direccion').value.trim(),
    };

    fetch('/paciente/actualizar', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify(formData)
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            showToast('Paciente actualizado correctamente.', 'success');
            cerrarModal('modalPaciente');
            setTimeout(() => location.reload(), 1000);
        } else {
            const msg = data.message || 'Error al actualizar.';
            if (msg.includes('DUI es obligatorio')) setError('err_edit_dui', msg);
            else if (msg.includes('DUI válido'))     setError('err_edit_dui', msg);
            else if (msg.includes('ya existe') || msg.includes('DUI')) setError('err_edit_dui', msg);
            else if (msg.includes('teléfono'))       setError('err_edit_telefono', msg);
            else if (msg.includes('nombre') || msg.includes('apellido')) { setError('err_edit_nombre', msg); setError('err_edit_apellido', msg); }
            else showToast(msg, 'error');
        }
    })
    .catch(() => showToast('Error de conexión.', 'error'));
});

document.getElementById('closeModalPaciente').addEventListener('click', () => cerrarModal('modalPaciente'));
document.getElementById('cancelModalPaciente').addEventListener('click', () => cerrarModal('modalPaciente'));
document.getElementById('modalPaciente').addEventListener('click', function(e) { if (e.target === this) cerrarModal('modalPaciente'); });

// ───────────────────────────── ELIMINAR PACIENTE ─────────────────────────────
function confirmarEliminar(dui, nombre) {
    duiAEliminar = dui;
    document.getElementById('confirmDesc').textContent = `¿Estás seguro de que deseas eliminar a "${nombre}"? Esta acción no se puede deshacer.`;
    abrirModal('modalConfirmarEliminar');
}

document.getElementById('cancelEliminar').addEventListener('click', () => { duiAEliminar = null; cerrarModal('modalConfirmarEliminar'); });
document.getElementById('modalConfirmarEliminar').addEventListener('click', function(e) { if (e.target === this) cerrarModal('modalConfirmarEliminar'); });

document.getElementById('confirmarEliminarBtn').addEventListener('click', function() {
    if (!duiAEliminar) return;
    fetch(`/paciente/${duiAEliminar}`, {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(r => r.json())
    .then(data => {
        cerrarModal('modalConfirmarEliminar');
        if (data.success) {
            showToast('Paciente eliminado correctamente.', 'success');
            setTimeout(() => location.reload(), 1000);
        } else {
            showToast(data.message || 'Error al eliminar.', 'error');
        }
    })
    .catch(() => showToast('Error de conexión.', 'error'));
});

// ───────────────────────────── BÚSQUEDA ─────────────────────────────
document.getElementById('searchInput').addEventListener('input', function() {
    const busqueda = this.value.toLowerCase();
    const rows = document.querySelectorAll('#pacientesBody tr');
    let visibles = 0;
    rows.forEach(row => {
        const nombre   = row.dataset.nombre   || '';
        const dui      = row.dataset.dui      || '';
        const telefono = row.dataset.telefono || '';
        const ok = nombre.includes(busqueda) || dui.includes(busqueda) || telefono.includes(busqueda);
        row.style.display = ok ? '' : 'none';
        if (ok) visibles++;
    });
    document.getElementById('tableInfo').textContent = `Mostrando ${visibles} paciente${visibles !== 1 ? 's' : ''}`;
    document.getElementById('emptyState').style.display = visibles === 0 ? 'block' : 'none';
});

// ───────────────────────────── PERFIL ─────────────────────────────
const chip = document.getElementById('profileChip');
const dropdown = document.getElementById('profileDropdown');
if (chip) chip.addEventListener('click', e => { e.stopPropagation(); dropdown.classList.toggle('open'); });
document.addEventListener('click', () => dropdown?.classList.remove('open'));
</script>
</body>
</html>
