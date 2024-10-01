<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Exibe o formulário de registro
    public function index()
    {
        $usuarios = User::paginate(5);
        return view('auth.index', compact('usuarios'));
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Trata o registro do usuário
    public function register(Request $request)
    {
        // Validação dos dados
        $this->validator($request->all())->validate();

        // Criação do usuário
        $user = $this->create($request->all());

        // Redireciona ou faz login
        return redirect()->route('usuarios.index')->with('success', 'Cadastro realizado com sucesso!');
    }

    // Validação dos dados
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // Cria o usuário na tabela users
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
