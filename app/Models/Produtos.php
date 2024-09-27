<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fornecedores;
use App\Models\Categorias;

class Produtos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'fornecedor_id',
        'categoria_id',
        'nome',
        'preco',
        'qtd_estoque',
        'preco_custo',
        'image',
        'status'
    ];

    public function Fornecedor()
    {
        return $this->belongsTo(Fornecedores::class, 'fornecedor_id', 'id');
    }

    public function Categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id', 'id');
    }
}
