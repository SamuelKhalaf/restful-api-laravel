<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('mobile',$request->mobile)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'msg' => 'The credentials are incorrect. Try again.'
            ], 401);
        }

        $token = $user->createToken($user->name);

        return response()->json(['auth-token' => $token->plainTextToken , 'user' => $user]);
    }

    public function logout(Request $request)
    {
        $user = User::where('id' , $request->id )->first();

        $user->tokens()->delete();

        return response()->json(['status'=>'true' , 'msg' => 'Logged out successfully']);
    }
}
