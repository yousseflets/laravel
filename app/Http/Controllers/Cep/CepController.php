<?php

namespace App\Http\Controllers\Cep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CepController extends Controller
{
    public function buscarCep($cep)
    {
        // Valida se o CEP tem o formato correto
        if (preg_match('/^[0-9]{5}-?[0-9]{3}$/', $cep)) {
            $cep = str_replace('-', '', $cep); // Remove o hífen se necessário
            $url = "https://viacep.com.br/ws/{$cep}/json/";

            // Faz a requisição à API ViaCEP
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            // Verifica se há erros na resposta
            if (isset($data['erro'])) {
                return response()->json(['error' => 'CEP não encontrado.'], 404);
            }

            // Retorna os dados do CEP
            return response()->json($data);
        } else {
            return response()->json(['error' => 'CEP inválido.'], 400);
        }
    }
}
