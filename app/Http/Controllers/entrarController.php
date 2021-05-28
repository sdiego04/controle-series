<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class entrarController extends Controller
{
    public function index(){
        return view('/entrar/entrar');
    }
    public function entrar(Request $request){

        if(!Auth::attempt($request->only(['email','password']))) {
            return redirect('entrar/entrar')->back()->withErrors("erro ao autenticar");
        }

        return redirect()->route('index.listaSeries');

    }
}
