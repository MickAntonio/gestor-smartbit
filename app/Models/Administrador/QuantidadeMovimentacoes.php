<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class QuantidadeMovimentacoes extends Model
{
    public function estoque()
    {
        return $this->belongsTo('App\Models\Administrador\Estoques');
    }

    public function movimentacao()
    {
        return $this->belongsTo('App\Models\Administrador\Movimentacoes');
    }

    public function produto()
    {
        return $this->belongsTo('App\Models\Administrador\Produtos');
    }
}
