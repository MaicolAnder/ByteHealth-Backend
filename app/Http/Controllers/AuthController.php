<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AuthUser;

class AuthController extends Controller
{
    private $Usuario_Usu;

    public function register(Request $request)
    {
        $Usuario_Usu = $request->Usuario_Usu;
        $Contrasena_Usu = $request->Contrasena_Usu;

        // Check if field is empty
        if (empty($Usuario_Usu) or empty($Contrasena_Usu)) {
            return response()->json(['error' => true, 'message' => 'You must fill all the fields']);
        }

        // Check if email is valid
        //if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //    return response()->json(['status' => 'error', 'message' => 'You must enter a valid email']);
        //}

        // Check if password is greater than 5 character
        if (strlen($Contrasena_Usu) < 3) {
            return response()->json(['error' => true, 'message' => 'La contraseña debe ser mayor a 3 caracteres']);
        }

        // Check if user already exist
        if (AuthUser::where('Usuario_Usu', '=', $Usuario_Usu)->exists()) {
            return response()->json(['error' => true, 'message' => 'El usuario ya está registrado']);
        }

        // Create new user
        try {
            $user = new AuthUser();
            $user->Email_Usu = $request->Usuario_Usu.'@margunsoft.com';
            $user->Usuario_Usu = $request->Usuario_Usu;
            $user->Contrasena_Usu = app('hash')->make($request->Contrasena_Usu);
            $user->Id_Per = 1;
            $user->Id_UsuEst = 3;
            $user->Id_Rol = 1;

            if ($user->save()) {
                return $this->login($request);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['error'=> false, 'message' => 'Hasta pronto']);
    }

    public function login(Request $request)
    {
        $this->Usuario_Usu = $request->Usuario_Usu;
        $Contrasena_Usu = $request->Contrasena_Usu;

        // Check if field is empty
        if (empty($this->Usuario_Usu) or empty($Contrasena_Usu)) {
            return response()->json(['error' => true, 'message' => 'Existe un error que no nos permite continuar']);
        }

        //$credentials = [
        //    'Usuario_Usu' => $Usuario_Usu,
        //    'Contrasena_Usu' =>$Contrasena_Usu
        //];
        // Array([Usuario_Usu]=>manager[Contrasena_Usu]=>admin)
        $credentials = request(['Usuario_Usu', 'Contrasena_Usu']);

        // dd(auth()->attempt('admin', 'password'));
        if (!$token = auth()->attempt($credentials)) {
            return response()->json([
                        'error' => true,
                        'message'=>'Datos de usuario o contraseña incorrectos',
                        'status'=>'Unauthorized'],
                    401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'error' => false,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 1600,
            'message' => $this->Usuario_Usu
        ]);
    }
}
