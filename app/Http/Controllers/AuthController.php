<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::first(); // simple for test

        return response()->json([
            'token' => $user->createToken('api')->plainTextToken,
        ]);
    }
}
