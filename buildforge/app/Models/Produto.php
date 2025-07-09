<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'descricao', 'preco', 'categoria_id', 'imagem'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function avaliacoes()
    {
        return $this->hasMany(\App\Models\Avaliacao::class);
    }
    
    public function mediaAvaliacoes()
    {
        return $this->avaliacoes()->avg('nota') ?? 0;
    }
    
}
