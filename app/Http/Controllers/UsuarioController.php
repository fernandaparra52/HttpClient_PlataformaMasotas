<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;



class UsuarioController extends Controller
{

    protected $apiUrl = 'https://api.example.com/api/usuarios';
    public function formulario()
    {
        return view("/usuarios/crear");
    }
    public function crear(Request $request)
    {
        dd($request->all());
        DB::beginTransaction(); // Iniciar la transacción
        try {
            // Validación
            $validatedData = $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|email|unique:usuarios,email',
                'contra' => 'required|min:6|confirmed',
                'rol' => 'required|in:usuario',
                'estado' => 'required|in:activo',
            ]);

            // Procesar la imagen si está presente
            if ($request->hasFile('imagen')) {
                // Guardar la imagen en 'public/imagenes' dentro de storage/app/public
                $rutaImagen = $request->file('imagen')->store('imagenes', 'public');
            }

            // Inserción en la base de datos
            DB::table('usuarios')->insert([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'contra' => bcrypt($validatedData['contra']), // Encriptar la contraseña
                'rol' => $validatedData['rol'],
                'estado' => $validatedData['estado'],
            ]);

            DB::commit(); // Confirmar la transacción
            return redirect('/usuarios/listado')->with('success', 'Usuario creado con éxito');

        } catch (ValidationException $e) {
            DB::rollBack(); // Revertir la transacción si hay un error de validación
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack(); // Revertir la transacción por cualquier otro error
            return redirect()->back()->with('error', 'Ocurrió un error al intentar registrar al usuario.')->withInput();
        }
    }

    //Muestra pagina perfil usuario con sus datos correspondientes
    public function perfil()
    {
        $usuarios = DB::table("users")
            ->get();
        return view("/usuario/perfil/perfil")->with('users', $usuarios);
    }

    public function actualizar(Request $request, $id)
    {
        // Validación
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'password' => 'required|min:6',
            'telefono' => 'required|max:15',
            'direccion' => 'nullable|max:255',
            'imagen' => 'nullable|file|mimes:jpg,jpeg,png|max:10240', // Validación para la imagen
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

         // Obtener los datos de entrada, excluyendo el token y método
         $data = $request->except('_token', '_method', 'imagen');

         // Manejo de archivos solo si hay una imagen subida
         if ($request->hasFile('imagen')) {
             $data['imagen'] = $request->file('imagen')->store('fotos', 'public');
         }
 
         // Solo agregar la contraseña si se ingresó una nueva
         if ($request->filled('password')) {
             $data['password'] = Hash::make($request->contra);
         } else {
             // Si no hay nueva contraseña, no incluirla en los datos a actualizar
             unset($data['password']);
         }
 
         // Actualizar los datos directamente en la base de datos
         DB::table('users')
             ->where('id', $id)
             ->update($data);
 
         // Almacenar datos del usuario en la sesión
         session([
             'userId' => $id,
             'userName' => $request->name,
             'userEmail' => $request->email,
             'userPhone' => $request->telefono,
             'userPassword' => $request->password,
             'userAddress' => $request->direccion,
             'userImage' => isset($data['imagen']) ? $data['imagen'] : session('userImage'),
         ]);
 
         return redirect()->back()->with('success', 'Usuario actualizado con éxito');
     }
 




    public function borrar($id)
    {
        DB::table("usuarios")
            ->where("id", "=", $id)
            ->update([
                "estado" => "Inactivo"
            ]);
        return redirect('/usuarios/listado');
    }
}
