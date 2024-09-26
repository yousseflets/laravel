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
        'quantidade',
        'total',
        'data_venda',
        'status'
    ];

    public function Produto()
    {
        return $this->belongsTo(Produtos::class, 'produto_id', 'id');
    }
}
