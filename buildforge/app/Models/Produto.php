<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'descricao', 'preco', 'categoria_id', /* outros campos */];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
