<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function connection(){
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail']);
        }
    }

    public function login(Request $request){
        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            $auth = Auth::user();
            $user = User::find($auth->id);
            $token = $user->createToken('Personal Access Token')->plainTextToken;
            return response()->json([
                'message' => 'Login successful!',
                'token' => $token,
                'status' => 'success',
            ]);
            // return response()->json($auth);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function user(Request $request){
        return $request->user();
    }

    //
}
