<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|email|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        //proveravamo da li je validacija uspesna
        if($validator->fails())
            return response()->json($validator->errors());

        //kreiramo usera
        $user = User::create([
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);

        //kreiramo token
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['data' => $user, 'access_token' => $token, 'token_type' =>'Bearer']);
    }
        
    public function login(Request $request){
        //proveravamo na osnovu emaila i passworda da li korisnik postoji u bazi
        //ako ne, onda ispisuje poruku
        if(!Auth::attempt($request->only('email', 'password')))
            return response()->json(['message' => 'Unauthorized', 401]);

        //ako postoji, kreiramo objekat korisnik preuzimajući njegove podatke iz baze na osnovu email-a
        $user = User::where('email', $request->email)->firstOrFail();

        //postavljamo token i vraćamo informaciju o tome nazad korisniku. Taj token ćemo koristiti za manipulaciju APIem
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['message'=>"Hi ". $user->username. ", wlcome to home page!",
         'access_token' => $token, 'token_type' =>'Bearer']);
    }
    
    public function logout(Request $request){
        $request->user()->token()->delete();
    }

}
