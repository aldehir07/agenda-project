<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - Sistema de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">

</head>
<body>
@include('plantilla.nabvar')
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="login-card">
                        <div class="login-header">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mb-4">
                            <h4>Bienvenido al Sistema</h4>
                            <p class="text-muted">Ingresa tus credenciales para continuar</p>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" 
                                    placeholder="nombre@ejemplo.com" value="{{ old('email') }}" required>
                                <label for="email">Correo Electrónico</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" 
                                    name="password" placeholder="Contraseña" required>
                                <label for="password">Contraseña</label>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="remember_me" 
                                    name="remember">
                                <label class="form-check-label" for="remember_me">
                                    Recordar mis datos
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-login">
                                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                            </button>

                            @if (Route::has('password.request'))
                                <div class="text-center mt-3">
                                    <a href="{{ route('password.request') }}" class="text-decoration-none">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                </div>
                            @endif

                            <div class="divider">
                                <span>¿No tienes cuenta?</span>
                            </div>

                            <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-login">
                                <i class="fas fa-user-plus me-2"></i>Registrarse
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
