<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class ProdutoVariacoes extends Model
{
    public function estoque()
    {
        return $this->belongsTo('App\Models\Administrador\Estoques');
    }

    public function atributo()
    {
        return $this->belongsTo('App\Models\General\Atributos', 'atributo_id');
    }
    
}
