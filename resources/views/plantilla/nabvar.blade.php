@if (Route::has('login'))
    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient" style="background-color: #1a237e;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('index') }}">
                <i class="fas fa-calendar-alt me-2"></i>
                <span>Sistema de Reservas</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @auth
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('registro.index') ? 'active' : '' }}" 
                               href="{{ route('registro.index') }}">
                                <i class="fas fa-book me-1"></i> Agenda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('calendario') ? 'active' : '' }}" 
                               href="{{ route('calendario') }}">
                                <i class="fas fa-calendar-plus me-1"></i> Reservar
                            </a>
                        </li>
                    </ul>
                    
                    <!-- Menú de usuario -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" 
                               id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-2"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" 
                               href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i> Iniciar Sesión
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" 
                                   href="{{ route('register') }}">
                                    <i class="fas fa-user-plus me-1"></i> Registrarse
                                </a>
                            </li>
                        @endif
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
@endif
