<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\GeneralActionRecord;
use App\Models\User;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function get_all_users(Request $request)
    {

        $users = User::with('role')->whereHas('status', function ($query) {
            $query->where('description', 'Activo');
        })->whereHas('role', function ($query) {
            $query->where('description', 'Usuario');
        })->get();

        return response()->json(['status' => true, 'data' => $users]);
    }
    public function get_logged_user_data(Request $request)
    {

        $user_data = [];
        $data = $request->user();
        $user_data = [
            'first_name' => $data->first_name,
            'middle_name' => $data->middle_name,
            'lastname' => $data->lastname,
            'second_lastname' => $data->second_lastname,
            'phone' => $data->phone,
            'status_id' => $data->status_id,
            'color' => $data->color,
            'email' => $data->email,
        ];
        $user = new User($user_data);
        $user->id = $data->id;
        $user->role_id = $data->role_id;
        $user->status_id = $data->status_id;
        $user->role = Role::find(['id' => $user->role_id])[0];
        $user->status = Status::find(['id' => $user->status_id])[0];
        return response()->json(['user' => $user]);
    }
    /**
     * Registrar Usuario
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'string|max:255',
            'lastname' => 'required|string|max:255',
            'second_lastname' => 'string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'document' => 'required|string|max:20|unique:users',
            'address' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }
        try {
            $user = User::create([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'lastname' => $request->lastname,
                'second_lastname' => $request->second_lastname,
                'phone' => $request->phone,
                'email' => $request->email,
                'document' => $request->document,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'color' => '#4caf50',
            ]);

            // Obtener departamento o crear status si no existe
            $dept = Department::where(['id' => $request->department])->first();
            $user->department()->associate($dept);

            // Obtener status activo o crear status si no existe
            $status = Status::firstOrNew(['description' => 'Activo']);
            $status->save();
            // Se asocia el status al usuario
            $user->status()->associate($status);

            // Obtener rol usaurio o crear rol si no existe
            $role = Role::firstOrNew(['description' => 'Usuario']);
            $role->save();
            // Se asocia el rol al usuario
            $user->role()->associate($role);

            // Se guarda el usuario
            $user->save();

            // Token de auth
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['data' => $user, 'token' => $token, 'token_type' => 'Bearer', 'status' => true], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'errors' => [$th->getMessage()]], 400);
        }
    }

    /**
     * Registrar administrador de condominios
     */
    public function register_master(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'string|max:255',
            'lastname' => 'required|string|max:255',
            'second_lastname' => 'string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'document' => 'required|string|max:20|unique:users',
            'address' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 400);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'lastname' => $request->lastname,
            'second_lastname' => $request->second_lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'document' => $request->document,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'color' => '#4caf50',
        ]);
        // Obtener status activo o crear status si no existe
        $status = Status::firstOrNew(['description' => 'Activo']);
        $status->save();

        // Se asocia el status al usuario
        $user->status()->associate($status);

        // Obtener rol cliente o crear rol si no existe
        $role = Role::firstOrNew(['description' => 'Master']);
        $role->save();

        // Se asocia el rol al usuario
        $user->role()->associate($role);

        // Se guarda el usuario
        $user->save();

        // Token de auth
        $token = $user->createToken("auth_token")->plainTextToken;

        return response()->json(['data' => $user, 'token' => $token, 'token_type' => 'Bearer', 'status' => true]);
    }

    /**
     * Login de usuario
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 401);
        }
        $user = User::with('role', 'status')->where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        $user->token = $token;
        $G_A_R = GeneralActionRecord::create([
            'description' => "El usuario $user->first_name $user->lastname ($user->document) inició sesión. ($user->email)",
            'importance' => 'Normal',
            'author' => 'SISGACI',
        ]);
        $G_A_R->user()->associate($user);
        $G_A_R->save();
        return response()->json([
            'status' => true,
            'message' => 'Bienvenido ' . $user->first_name,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    /**
     * Cerrar sesion
     */
    public function logout(Request $request)
    {
        $user = $request->user();
        $G_A_R = GeneralActionRecord::create([
            'description' => "El usuario $user->first_name $user->lastname ($user->document) cerró sesión. ($user->email)",
            'importance' => 'Leve',
            'author' => 'SISGACI',
        ]);
        $G_A_R->user()->associate($user);
        $G_A_R->save();
        $request->user()->currentAccessToken()->delete();
        return [
            'status' => true,
            'message' => 'Has cerrado sesion exitosamente'
        ];
    }

    public function edit_user(Request $request, User $user)
    {

        if ($request->password != $request->confirmarPassword) {
            return response()->json(['status' => false, 'errors' => 'Las contraseñas no coinciden'], 400);
        }

        $validator = Validator::make($request->all(), [
            'phone' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'string|min:8',
        ]);

        if (!$validator->fails()) {
            return response()->json(['status' => false, 'errors' => [$validator->errors()]], 400);
        }
        $prev_email = $user->email;
        $prev_phone = $user->phone;
        $new_password = $request->password;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        $G_A_R = GeneralActionRecord::create([
            'description' => "El usuario $user->first_name $user->lastname ($user->document) edito sus datos, Email: $prev_email, Tlf: $prev_phone, Pass: $new_password. ($user->email)",
            'importance' => 'Alta',
            'author' => 'SISGACI',
        ]);
        $G_A_R->user()->associate($user);
        $G_A_R->save();
        return response()->json(['status' => true, 'message' => 'Se ha editado el usuario', 'user' => $user], 200);
    }

    public function edit_color(Request $request, User $user)
    {
        if (!$request->color) {
            return response()->json(['status' => false, 'message' => 'El color es obligatorio'], 400);
        }
        $user->color = $request->color;
        $user->save();

        return response()->json(['status' => true, 'message' => 'Se ha cambiado el color'], 200);
    }
}
