<?php

namespace App\Http\Controllers\Cep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CepController extends Controller
{
    public function buscarCep($cep)
    {
        if (preg_match('/^[0-9]{5}-?[0-9]{3}$/', $cep)) {
            $cep = str_replace('-', '', $cep);
            $url = "https://viacep.com.br/ws/{$cep}/json/";
            $response = file_get_contents($url);
            $data = json_decode($response, true);
            if (isset($data['erro'])) {
                return response()->json(['error' => 'CEP não encontrado.'], 404);
            }
            return response()->json($data);
        } else {
            return response()->json(['error' => 'CEP inválido.'], 400);
        }
    }
}
