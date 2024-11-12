<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome')}}">Adoptame</a>
        <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
            aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                        href="{{ route('galeria')}}">Galeria</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                        href="{{ route('somos')}}">Nosotros</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                        href="{{ route('visitanos')}}">Visitanos</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                        href="{{ route('contacto')}}">Contacto</a></li>

                <li class="nav-item dropdown mx-0 mx-lg-1">
                    <a class="nav-link dropdown-toggle py-3 px-0 px-lg-3 rounded" href="#" id="navbarDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Adopta
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('login') }}">Iniciar Sesión</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">Crear Cuenta</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>