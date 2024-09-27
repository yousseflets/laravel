<?php

namespace App\Http\Controllers\Historico;

use App\Http\Controllers\Controller;
use App\Models\Historico;
use App\Models\Produtos;
use App\Models\Vendas;
use Illuminate\Http\Request;

class HistoricoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Vendas::query();

        if ($startDate || $endDate) {
            $query->whereHas('historico', function ($q) use ($startDate, $endDate) {
                if ($startDate) {
                    $q->whereDate('data_venda', '>=', $startDate);
                }

                if ($endDate) {
                    $q->whereDate('data_venda', '<=', $endDate);
                }
            });
        }

        $historico = Historico::orderBy('id', 'desc')->paginate(10);

        return view('historico.index', compact('historico'));
    }
}
