<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
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
