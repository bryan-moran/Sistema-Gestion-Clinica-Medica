<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Clínica Bienestar — Iniciar sesión</title>
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
</head>
<body>

  <div class="login-bg" aria-hidden="true">
    <img src="{{ asset('assets/img/clinica.png') }}" alt="Clínica Bienestar" />
  </div>

  <main class="login-page">
    <div class="login-card">

      <div class="login-logo-wrap">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Clínica Bienestar" class="login-logo" />
      </div>

      <div class="login-header">
        <h1>Bienvenido de nuevo</h1>
        <p>Acceso exclusivo para personal autorizado</p>
      </div>

      @if ($errors->any())
        <div class="login-alert" role="alert" id="loginAlert">
          {{ $errors->first() }}
        </div>
      @endif

      <form class="login-form" method="POST" action="{{ route('login.post') }}" novalidate>
        @csrf

        <div class="field-group">
          <label for="usuario">Usuario</label>
          <div class="input-wrap">
            <input type="text" id="usuario" name="usuario"
              placeholder="Ingresa tu usuario"
              value="{{ old('usuario') }}"
              autocomplete="off" required />
            <svg class="field-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
              <circle cx="12" cy="7" r="4"/>
            </svg>
          </div>
        </div>

        <div class="field-group">
          <label for="contrasena">Contraseña</label>
          <div class="input-wrap">
            <input type="password" id="contrasena" name="contrasena"
              placeholder="Ingresa tu contraseña"
              autocomplete="new-password" required />
            <svg class="field-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
              <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            <button type="button" class="toggle-pass" id="togglePass" aria-label="Mostrar contraseña">
              <svg id="eyeShow" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/>
                <circle cx="12" cy="12" r="3"/>
              </svg>
              <svg id="eyeHide" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" style="display:none">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19M1 1l22 22"/>
              </svg>
            </button>
          </div>
        </div>

        <div class="form-options">
          <label class="remember-label">
            <input type="checkbox" name="recordar" />
            Recordarme
          </label>
        </div>

        <button type="submit" class="btn-login">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
            <polyline points="10 17 15 12 10 7"/>
            <line x1="15" y1="12" x2="3" y2="12"/>
          </svg>
          Iniciar sesión
        </button>

      </form>

      <footer class="login-footer">
        <strong>Clínica Bienestar</strong><br>
        Sistema de Gestión Clínica &copy; {{ date('Y') }}<br>
        Acceso restringido solo a personal autorizado.
      </footer>

    </div>
  </main>

  <script>
    window.addEventListener('DOMContentLoaded', () => {
      document.getElementById('usuario').value    = '';
      document.getElementById('contrasena').value = '';

      const alert = document.getElementById('loginAlert');
      if (alert) {
        setTimeout(() => {
          alert.style.transition = 'opacity 1.8s ease, max-height 1.8s ease, margin 1.8s ease, padding 1.8s ease';
          alert.style.opacity    = '0';
          alert.style.maxHeight  = '0';
          alert.style.margin     = '0';
          alert.style.padding    = '0';
          alert.style.overflow   = 'hidden';
        }, 10000);
      }
    });

    const toggleBtn = document.getElementById('togglePass');
    const passInput = document.getElementById('contrasena');
    const eyeShow   = document.getElementById('eyeShow');
    const eyeHide   = document.getElementById('eyeHide');

    toggleBtn.addEventListener('click', () => {
      const isPass = passInput.type === 'password';
      passInput.type        = isPass ? 'text'    : 'password';
      eyeShow.style.display = isPass ? 'none'    : 'block';
      eyeHide.style.display = isPass ? 'block'   : 'none';
      toggleBtn.setAttribute('aria-label', isPass ? 'Ocultar contraseña' : 'Mostrar contraseña');
    });
  </script>

</body>
</html>