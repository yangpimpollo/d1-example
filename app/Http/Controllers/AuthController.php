<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function home_welcome(Request $request){ return response()->json([ 'message' => 'Welcome ComePizza!🍕 API', 'by' => 'yangpimpollo',]);}
    public function home_login(Request $request){ return response()->json([ 'message' => 'quiero iniciar sección' ]);}
    public function home_dashboard(Request $request){ 
        $staff = $request->user();
        return response()->json([ 'message' => 'estas en dashboard', 
                                  'user' => $staff->dni, 
                                  'store_id' => $staff->store_id
                                ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'dni' => 'required',
            'password' => 'required',
        ]);

        $staff = Staff::where('dni', $request->dni)->first();

        if (!$staff || !Hash::check($request->password, $staff->password)) {
            throw ValidationException::withMessages([
                'dni' => ['Las credenciales son incorrectas.'],
            ]);
        }

        $token = $staff->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            'user' => $staff,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout exitoso'
        ]);
    }
}
