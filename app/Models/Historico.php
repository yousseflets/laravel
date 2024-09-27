<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'produto_id',
        'venda_id'
    ];


    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function Produto()
    {
        return $this->belongsTo(Produtos::class, 'produto_id', 'id');
    }

    public function Venda()
    {
        return $this->belongsTo(Vendas::class, 'venda_id', 'id');
    }
}
