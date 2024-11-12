<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        //dd($request->all()); 
        // Validar los datos de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);


        // Recuperar el usuario por el email
        $users = DB::table('users')->where('email', $request->email)->first();
        // dd(Hash::check($request->password, $users->password));
        // Verificar si el usuario existe y si la contraseña es correcta
        if ($users && Hash::check($request->password, $users->password)) {
            // Verificar el estado del usuario
            if ($users->estado != 'activo') {
                return back()->withErrors(['email' => 'Tu cuenta está inactiva.']);
            }

            // Autenticar manualmente al usuario
            Auth::loginUsingId($users->id);

            // Almacenar datos del usuario en la sesión
            session([
                'userId' => $users->id,
                'userName' => $users->name,
                'userEmail' => $users->email,
                'userPassword' => $users->password,
                'userPhone' => $users->telefono,
                'userAddress' => $users->direccion,
                'userImage' => $users->imagen,



            ]);

            // Redirigir según el rol del usuario
            switch ($users->rol) {
                case 'admin':
                    // Mantener al usuario en la misma página pero mostrar un mensaje de error
                    return back()->with('error', 'No tienes acceso a la parte de cliente.');

                case 'usuario':
                    // Redirigir al dashboard del usuario
                    return redirect()->route('inicio');

                default:
                    // Redirigir a la página de login o una ruta por defecto
                    return redirect()->route('login');
            }



        }

        // Si falla la autenticación, regresar con un mensaje de error
        return back()->withErrors(['email' => 'Correo o contra incorrectas']);
    }



    public function showSignupForm()
    {
        return view('auth.register');
    }

    // Manejar la creación de un nuevo usuario
    public function signup(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6|confirmed', // Confirmación de contraseña
        ]);

        try {
            // Iniciar una transacción de base de datos
            DB::beginTransaction();

            // Crear un nuevo usuario en la base de datos
            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password), // Encriptar la contraseña
                'estado' => 'activo',  // Estado por defecto
                'rol' => 'usuario',  // Rol por defecto
            ]);

            // Obtener el usuario recién creado
            $user = DB::table('users')->where('email', $request->email)->first();

            // Autenticar al usuario después del registro
            Auth::loginUsingId($user->id);

            // Confirmar la transacción
            DB::commit();

            // Redirigir al dashboard o página principal
            return redirect()->route('inicio');
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            // Redirigir con mensaje de error
            return redirect()->back()->withErrors(['error' => 'Ocurrió un error durante el registro. Por favor, inténtelo de nuevo.']);
        }
    }

    // Método para cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome')->with('success', 'Sesión cerrada con éxito');
    }

    // Método para redirigir al usuario a Google
    public function redirectToGoogle()
    {
        // Agregar el parámetro 'prompt' para forzar la selección de cuenta
        return Socialite::driver('google')->with(['prompt' => 'select_account'])->redirect();
    }

    // Método para manejar el callback de Google
    public function handleGoogleCallback()
    {
        
        try {
            // Obtener la información del usuario desde Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Verificar si se obtuvo el correo electrónico del usuario desde Google
            if (!$googleUser->getEmail()) {
                return redirect()->route('login')->withErrors(['email' => 'No se pudo obtener un correo electrónico de Google.']);
            }

            // Normalizar el email para evitar problemas de mayúsculas/minúsculas
            $email = strtolower($googleUser->getEmail());

            // Buscar si el usuario ya existe en la base de datos por email o por google_id
            $existingUser = DB::table('users')
                ->where('email', $email)
                ->orWhere('google_id', $googleUser->getId())  // Comparar por google_id también
                ->first();

                
            if ($existingUser) {
                // Si el usuario existe pero no tiene google_id (registro manual), lo asignamos
                if (!$existingUser->google_id) {
                    DB::table('users')->where('id', $existingUser->id)->update([
                        'google_id' => $googleUser->getId(),
                    ]);
                }

                // Autenticar al usuario
                Auth::loginUsingId($existingUser->id);

                // Confirmar la transacción
                DB::commit();

                // Redirigir al dashboard o página principal
                return redirect()->route('inicio');
            } else {
                // Si no existe, registrar al nuevo usuario
                DB::beginTransaction();

                try {
                    // Insertar un nuevo usuario en la base de datos con el rol 'usuario'
                    $newUserId = DB::table('users')->insertGetId([
                        'name' => $googleUser->getName(),
                        'email' => $email,
                        'google_id' => $googleUser->getId(),
                        'password' => Hash::make(Str::random(16)),  // Generar una contraseña aleatoria
                        'imagen' => $googleUser->getAvatar(),  // Guardar la imagen del perfil de Google
                        'estado' => 'activo',  // Estado por defecto
                        'rol' => 'usuario',  // Asignar el rol 'usuario'
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Autenticar al nuevo usuario
                    Auth::loginUsingId($newUserId);

                    // Confirmar la transacción
                    DB::commit();

                    // Redirigir al dashboard o página principal
                    return redirect()->route('inicio');
                } catch (\Exception $e) {
                    // Si algo falla, hacer rollback de la transacción
                    DB::rollBack();

                    // Registrar el error en los logs
                    Log::error('Error al registrar el nuevo usuario: ' . $e->getMessage());

                    // Redirigir al login con un mensaje de error
                    return redirect()->route('login')->withErrors(['error' => 'Ocurrió un error al intentar registrar el usuario.']);
                }
            }
        } catch (\Exception $e) {
            // En caso de error, manejar la excepción
            return redirect()->route('login')->withErrors(['error' => 'Ocurrió un error al iniciar sesión con Google.']);
        }
    }


}
