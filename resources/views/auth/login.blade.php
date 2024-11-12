<!DOCTYPE html>
<html>

<head>
	<title>ADOPTAME</title>
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
					<form action="/login" method="POST">
						@csrf
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="email" class="form-control input_user" value=""
								placeholder="email">
						</div>
						<!-- Campo de contraseña -->
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" value=""
								placeholder="password">
						</div>

						<!-- Botón de inicio de sesión con Google debajo de la contraseña -->
						<div class="d-flex justify-content-center mt-3 login_container">
							<a href="{{ route('google.redirect') }}" class="btn google_btn">
								<i class="fab fa-google"></i>
							</a>
						</div>

						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Remember me</label>
							</div>
						</div>

						<div class="d-flex justify-content-center mt-3 login_container">
							<button type="submit" id="loginButton" name="button" class="btn login_btn">Login</button>
						</div>
					</form>

			

					@if ($errors->any())
						<div>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif


					@if(session('error'))
						<div class="alert alert-danger">
							{{ session('error') }}
						</div>
					@endif


				</div>

				<div class="mt-4">

					<div class="d-flex justify-content-center links">
						<a href="#">Forgot your password?</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		// Añade la función para redirigir cuando se hace clic en el botón de login
		document.getElementById("loginButton").onclick = function () {
			// Aquí puedes validar el inicio de sesión antes de redirigir
			// Si es exitoso, redirigir
			window.location.href = "admin";
		};
	</script>
</body>

</html>