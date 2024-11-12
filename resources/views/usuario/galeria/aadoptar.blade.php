<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Hola, Usuario {{ session('userId') }}</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />

    <link href="/css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">

    @include('partials.navegation_usu')


    <header class="masthead bg-primary text-white text-center">
        <div class="container">
            <h1>Requisitos para Adoptar a Mascota</h1>
            <p class="lead">Por favor, revisa y acepta los siguientes requisitos antes de continuar con el proceso de
                adopción.</p>

            <ul class="list-unstyled">
                <li>- Tener más de 18 años.</li>
                <li>- Contar con un espacio adecuado para el animal.</li>
                <li>- Compromiso a largo plazo con el bienestar del animal.</li>
                <li>- Proveer atención veterinaria y alimentación.</li>
                <li>- Permitir visitas de seguimiento si es necesario.</li>
            </ul>

            <form action="{{ route('usuario.solicitudes.adopta') }}" method="POST">
                @csrf
                <input type="hidden" name="id_mascota"
                    value="{{ $mascota->id }}"><!-- Campo oculto para el ID de la mascota -->
                <button class="btn btn-xl btn-outline-light mt-3" type="submit">
                    <i class="fas fa-paw"></i> ¡Adóptame!
                </button>
            </form>
            <br>
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

        </div>
    </header>





    <footer class="footer text-center">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4"></h4>
                    <p class="lead mb-0">
                        <br />
                    </p>
                </div>

                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Redes Sociales</h4>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i
                            class="fab fa-fw fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social mx-1" href="#!"><i
                            class="fab fa-fw fa-linkedin-in"></i></a>
                </div>

            </div>
        </div>
    </footer>

    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright &copy; Adoptame CUT 2024</small></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>