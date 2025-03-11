<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin; 
use Illuminate\Support\Facades\Route;

class UserAuthController extends Controller
{
    public function register(Request $request){
        $registerUserData = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|min:8'
        ]);
        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password']),
        ]);
        return response()->json([
            'message' => 'User Created ',
        ]);
    }
    
    public function login(Request $request){
        $loginUserData = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|min:8'
        ]);
        $user = User::where('email',$loginUserData['email'])->first();
        if(!$user || !Hash::check($loginUserData['password'],$user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }
        
        $token = $user->createToken('UserToken')->plainTextToken;
        
        return response()->json([
            'message' => 'Login successful',
            'token' => $token
        ], 200);
    }
    
    public function logout(){
        auth()->user()->tokens()->delete();
    
        return response()->json([
          "message"=>"logged out"
        ]);
    }
    
    public function adminLogin(Request $request){
        $loginUserData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|min:8'
        ]);
    
        $admin = Admin::where('email', $loginUserData['email'])->first();
    
        if (!$admin) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }
    
        if ($admin->password !== $loginUserData['password']) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }
    
        $token = $admin->createToken('AdminToken')->plainTextToken;
    
        return response()->json([
            'message' => 'admin Login successful',
            'token' => $token
        ], 200);
    }
}