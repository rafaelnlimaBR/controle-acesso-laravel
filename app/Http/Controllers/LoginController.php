<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function logar()
    {
        try{
            $validacao = Validator::make(request()->all(),[
               'email' => 'required|email',
               'password' => 'required'
            ]);
            $credentials = [
                'email' => \request()->get('email'),
                'password' => \request()->get('password'),
            ];
            if ($validacao->fails()) {
                return redirect()->back()->withErrors($validacao)->withInput();
            }

            if(Auth::attempt($credentials, request()->get('lembrar'))){
                if (!\auth()->user()->ativo or \auth()->user()->grupos()->where('ativo',false)->count() > 0){
                    return $this->logout();
                }
                \request()->session()->regenerate();

                return redirect()->intended();
            }

            return redirect()->back()->with('error','erro ao logar')->onlyInput('email');
        }catch (\Exception $e){
            return redirect()->route('login')->with('error',$e->getMessage());
        }
    }

    public function logout()
    {
        if(Auth::check()){
            \auth()->logout();
            \request()->session()->invalidate();
            \session()->regenerateToken();
        }

        return redirect()->route('login');

    }
}
