<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ADOPTAME</title>

    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />

    <link href="/css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">

    @include('partials.navegation')


    <header class="masthead bg-primary text-white text-center">
        <div class="container">


            <div class="container">
                <h1>{{ $mascota->nombre }}</h1>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ 'http://localhost:8001/storage/' . $mascota->foto1 }}"
                            alt="Foto de {{ $mascota->nombre }}" style="width:100%;">
                    </div>
                    <div class="col-md-6">
                        <p><strong>Edad:</strong> {{ $mascota->edad }} años</p>
                        <p><strong>Sexo:</strong> {{ $mascota->sexo }}</p>
                        <p><strong>Especie:</strong> {{ $mascota->especie }}</p>
                        <p><strong>Descripción:</strong> {{ $mascota->descripcion }}</p>
                        <p><strong>Estado de salud:</strong> {{ $mascota->estado_salud }}</p>
                        <p><strong>Tamaño:</strong> {{ $mascota->tamano }}</p>
                        <p><strong>Estado de adopción:</strong> {{ $mascota->estado_adopcion }}</p>
                        <p><strong>Fecha de ingreso:</strong> {{ $mascota->fecha_ingreso }}</p>
                    </div>
                </div>

                <h2>Más Fotos</h2>
                <div class="row">
                    @if ($mascota->foto2)
                        <div class="col-md-4">
                            <img src="{{ 'http://localhost:8001/storage/' . $mascota->foto2 }}"
                                alt="Imagen de {{ $mascota->nombre }}" alt="Foto adicional de {{ $mascota->nombre }}"
                                style="width:100%;">
                        </div>
                    @endif
                    @if ($mascota->foto3)
                        <div class="col-md-4">
                            <img src="{{ 'http://localhost:8001/storage/' . $mascota->foto3 }}"
                                alt="Foto adicional de {{ $mascota->nombre }}" style="width:100%;">
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <a class="btn btn-xl btn-outline-light" href="/galeria">
                            ¡Adoptame!
                        </a>
                    </div>
                </div>
            </div>


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

    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" aria-labelledby="portfolioModal1"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button></div>
                <div class="modal-body text-center pb-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">

                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Nuestro centro</h2>

                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>

                                <img class="img-fluid rounded mb-5" src="assets/img/portfolio/cutonala1.png"
                                    alt="..." />

                                <p class="mb-4">eccnerknlcndlfknrlneoototiot fieiceirvinrinei.</p>
                                <button class="btn btn-primary" data-bs-dismiss="modal">
                                    <i class="fas fa-xmark fa-fw"></i>
                                    Cerrar ventana
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" aria-labelledby="portfolioModal2"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button></div>
                <div class="modal-body text-center pb-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">

                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Nosotros</h2>

                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>

                                <img class="img-fluid rounded mb-5" src="assets/img/portfolio/cutonala3.jpeg"
                                    alt="..." />

                                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque
                                    assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam
                                    velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.
                                </p>
                                <button class="btn btn-primary" data-bs-dismiss="modal">
                                    <i class="fas fa-xmark fa-fw"></i>
                                    Cerrar ventana
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Portfolio Modal 3-->
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" aria-labelledby="portfolioModal3"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button></div>
                <div class="modal-body text-center pb-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <!-- Portfolio Modal - Title-->
                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">desde...</h2>
                                <!-- Icon Divider-->
                                <div class="divider-custom">
                                    <div class="divider-custom-line"></div>
                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                    <div class="divider-custom-line"></div>
                                </div>
                                <!-- Portfolio Modal - Image-->
                                <img class="img-fluid rounded mb-5" src="assets/img/portfolio/cutonala2.jpeg"
                                    alt="..." />
                                <!-- Portfolio Modal - Text-->
                                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque
                                    assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam
                                    velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.
                                </p>
                                <button class="btn btn-primary" data-bs-dismiss="modal">
                                    <i class="fas fa-xmark fa-fw"></i>
                                    Cerra ventana
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/scripts.js"></script>

    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="js/scripts.js"></script>

<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>