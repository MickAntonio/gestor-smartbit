<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class QuantidadeProdutosDanificados extends Model
{
    public function estoque()
    {
        return $this->belongsTo('App\Models\Administrador\Estoques');
    }

    public function produto_danificado()
    {
        return $this->belongsTo('App\Models\Administrador\ProdutosDanificados');
    }
}
