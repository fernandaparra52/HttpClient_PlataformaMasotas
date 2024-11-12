<!DOCTYPE html>
<html>

<head>
    <title>Crear Cuenta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    <link href="css/inicio.css" rel="stylesheet" />
</head>

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="assets/img/iniciose/image.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <!-- Mensajes de error -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Mensajes de éxito -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Campo para el nombre -->
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="nombre" maxlength="100" class="form-control input_user" value="{{ old('nombre') }}" placeholder="Nombre"
                                required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" maxlength="100" class="form-control input_user"  value="{{ old('email') }}" placeholder="Email">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password"  required minlength="6" class="form-control input_pass"
                                placeholder="Contraseña">
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" id="registerButton" name="button" class="btn login_btn">Crear
                                Cuenta</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <script>
        // Aquí puedes validar la creación de cuenta antes de redirigir
        document.getElementById("registerButton").onclick = function () {
            // Si es exitoso, redirigir (opcional)
            // window.location.href = "home"; // Cambia a la ruta adecuada después de la creación
        };
    </script>
</body>

</html>