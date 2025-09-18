<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class LoginController extends Controller
{
     public function Login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return response()->json(['error' => 'Email not found'], 404);
        }

        $validPassword = Hash::check($credentials['password'], $user->password);
        if (!$validPassword) {
            return response()->json(['error' => 'Invalid password'], 401);
        }
        
 $sharedPermissions = ['createStudent','editUser','createModule','editModule','deleteModule']; //Persmisos compartidos
$professorPermissions = array_merge($sharedPermissions, ['professor']);
$adminPermissions = array_merge($sharedPermissions, ['admin','createTeacher']);
 $permissions = match($user->role) {
    "professor" => $professorPermissions,
    "admin"   => $adminPermissions,
    "student"     => ['student'],   
 };    
     try {
            $token = JWTAuth::claims(['permissions' => $permissions])->fromUser($user);
            } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        return response()->json([
            'username' => $user->name,
            'role'=>$user->role,
            'token' => $token
        ], 200);
    }

    public function Logout()
    {
        try {
            JWTAuth::parseToken()->invalidate();

            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }
    }
}
