<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemPedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'produto_id',
        'quantidade',
        'preco',
    ];

    // Relacionamento: um ItemPedido pertence a um Pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    // Relacionamento: um ItemPedido pertence a um Produto
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
