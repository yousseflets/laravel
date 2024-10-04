<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produtos;

class Vendas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'produto_id',
        'user_id',
        'quantidade',
        'total',
        'data_venda',
        'desconto',
        'lucro_venda',
        'status',
        'metodo_pagamento_id',
        'parcelado',
        'qtd_parcelado'
    ];

    public function Produto()
    {
        return $this->belongsTo(Produtos::class, 'produto_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function metodoPagamento()
    {
        return $this->belongsTo(MetodoPagamento::class, 'metodo_pagamento_id', 'id');
    }


}
