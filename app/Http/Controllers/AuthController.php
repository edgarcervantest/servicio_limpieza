<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $nombreCompleto = $request->first_name . ' ' . $request->last_name;

        $user = User::create([
            'name' => $nombreCompleto,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        #Redirigir o iniciar sesion automaticamente
        auth()->login($user);
        return redirect()->route('home')->with('success', 'Usuario registrado');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'El correo o la contraseña son incorrectos.',
        ])->onlyInput('email');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }

}