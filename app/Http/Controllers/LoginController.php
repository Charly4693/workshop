<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginPost $request){
        $usuario = User::where('name', $request->name)->first();
        if (!$usuario || !Hash::check($request->password, $usuario->password)){
            $error = 'Usuario incorrecto';
            return view('login', compact('error'));
        } else {
            return redirect()->route('companies.index');
        }
    }
}
