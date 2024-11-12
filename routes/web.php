<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MascotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\AdopcionController;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PayPalController;

//RUTAS HOME
// Ruta para la vista inicial
Route::get('/', function () {
    return view('welcome');
})->name('welcome'); // Aquí asignas el nombre a la ruta
// Ruta para la vista de la galería
Route::get('/galeria', [MascotaController::class, 'index'])->name('galeria')->middleware('auth');
// Ruta para la vista "somos"
Route::get('/somos', function () {
    return view('somos'); // Asegúrate de que tienes una vista llamada 'somos.blade.php'
})->name('somos'); // Aquí asignas el nombre a la ruta
// Ruta para la vista "visitanos"
Route::get('/visitanos', function () {
    return view('visitanos'); // Asegúrate de que tienes una vista llamada 'visitanos.blade.php'
})->name('visitanos'); // Aquí asignas el nombre a la ruta
// Ruta para la vista "contacto"
Route::get('/contacto', function () {
    return view('contacto'); // Asegúrate de que tienes una vista llamada 'contacto.blade.php'
})->name('contacto'); // Aquí asignas el nombre a la ruta

//RUTAS NAVBAR
// Ruta para la lista de mascotas usuario
Route::get('/mascotas', [MascotaController::class, 'index'])->name('mascotas');



// Ruta para el registro de usuario
Route::get('/register', [AuthController::class, 'showSignupForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'signup'])->name('register');

//RUTAS LOGIN / LOGOUT
// Rutas para el inicio de sesión
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// Ruta para cerrar sesión
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//RUTAS PARA CREAR USUARIO
Route::get('/usuarios/formulario', [UsuarioController::class, 'formulario']);
Route::post('/usuarios/nuevo', [UsuarioController::class, 'crear']);


//RUTAS API GOOGLE
Route::get('/google-auth/redirect', function () {
    return Socialite::driver(driver: 'google')->redirect();
});


Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->stateless()->user();
    // dd($user_google);
    $user = User::updateOrCreate([
        'google_id' => $user_google->id,
    ], [
        'name' => $user_google->name,
        'email' => $user_google->email,
        'google_token' => $user_google->token,
        'google_refresh_token' => $user_google->refreshToken,

    ]);

    Auth::login($user);

    return redirect('/usuario/inicio');
});

// Ruta para redirigir a Google para iniciar sesión
Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');

// Ruta para manejar el callback de Google
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');


// Ruta para la página de inicio después del inicio de sesión
Route::get('/usuario/inicio', function () {
    return view('usuario.inicio'); // Nota: Laravel usa puntos en lugar de barras para vistas
})->name('inicio');

 
//Editar usuario perfil
Route::get('/usuario/editar', [UsuarioController::class, 'perfil'])->name('perfil_usuario'); //Ruta a pagina perfil
Route::put('/usuario/actualizar/{id}', [UsuarioController::class, 'actualizar']);


//galeria mascotas
Route::get('/usuario/galeria/mascotas', [MascotaController::class, 'listado'])->name('mascotas.listado');
Route::get('/usuario/galeria/mascota/{id}', [MascotaController::class, 'detalle_usu'])->name('mascota.detalle.usu');
//Mandar solicitud adopcion
Route::get('/usuario/galeria/aadoptar/{id}', [AdopcionController::class, 'datos_adoptar'])->name('usuario.galeria.aadoptar');
Route::post('/usuario/galeria/aadoptar', [AdopcionController::class, 'adoptar'])->name('usuario.solicitudes.adopta');
//Ver solicitudes
Route::get('/usuario/solicitudes/adoptar', [AdopcionController::class, 'verSolicitudes'])->name('usuario.solicitudes.ver');



// Agrupar rutas protegidas por el middleware `auth`
Route::middleware(['auth'])->group(function () {

    // Ruta para ver notificaciones
    Route::get('/notificaciones', [NotificationController::class, 'index'])->name('notificaciones');


    // Ruta para ver una notificación específica
    Route::get('/notificaciones/{id}', [NotificationController::class, 'show'])->name('notificaciones.show');

    // Ruta para eliminar una notificación
    Route::delete('/notificaciones/{id}', [NotificationController::class, 'destroy'])->name('notificaciones.destroy');
});






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Paypal
Route::get('/auth/paypal', [PayPalController::class, 'index'])->name('paypal');
Route::get('paypal/payment', [PayPalController::class, 'payment'])->name('paypal.payment');
Route::get('paypal/payment/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [PayPalController::class, 'paymentCancel'])->name('paypal.payment/cancel');
