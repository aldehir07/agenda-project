@if (Route::has('login'))
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @auth
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('registro.index')}}">Agenda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('calendario') }}">Reservar</a>
                        </li>
                    </ul>
                    <!-- Cerrar Sesión alineado a la derecha -->
                    <div class="ms-auto">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-white" style="border: none; background: none; cursor: pointer;">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                @else
                    <div class="ms-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
@endif
