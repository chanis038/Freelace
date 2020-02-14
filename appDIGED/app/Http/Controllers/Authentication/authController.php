<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class authController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest', ['only' => 'index']);
    }

    public function index()
    {
        return view('login/login');
    }

    public function login()
    {

        $credentials = $this->validate(request(), [
            $this->username() => 'required|numeric',
            'password'        => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {

            //return auth()->user()->password;

            return redirect()->route('dashboard');
        }

        return back()
            ->withErros(['registro' => 'no se encontro registro con las credenciales ingresadas'])
            ->withInput(request([$this->username()]));
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function username()
    {
        return 'registro';
    }

}
