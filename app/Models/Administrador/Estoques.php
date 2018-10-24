<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class Estoques extends Model
{

    public function produto_variacoes()
    {
        return $this->hasMany('App\Models\Administrador\ProdutoVariacoes', 'estoque_id');
    }

    public function produto()
    {
        return $this->belongsTo('App\Models\Administrador\Produtos');
    }
    
}
