<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function register(Request $request)
    // {
    //     // Validação dos dados
    //     $this->validator($request->all())->validate();

    //     // Criação do usuário
    //     $user = $this->create($request->all());

    //     // Fazer login automaticamente
    //     Auth::login($user);

    //     return redirect()->route('home')->with('success', 'Cadastro realizado com sucesso e usuário logado!');
    // }

    protected function authenticated($request, $user)
    {
        if ($user->password_change_required) {
            return redirect()->route('password.change');
        }

        return redirect()->intended('home'); // Redireciona para a página de destino padrão
    }
}
