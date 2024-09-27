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
        'desconto',
        'status'
    ];

    public function Produto()
    {
        return $this->belongsTo(Produtos::class, 'produto_id', 'id');
    }
    public function Historico()
    {
        return $this->hasMany(Historico::class, 'id', 'venda_id');
    }

    public function vendaCancelada()
    {
        if ($this->status !== 0) {
            foreach ($this->products as $product) {
                $product->updateEstoque($product->pivot->quantity);
            }
            $this->status = 0;
            $this->save();
        }
    }
}
