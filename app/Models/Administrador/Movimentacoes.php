<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class Movimentacoes extends Model
{
    public function produto()
    {
        return $this->belongsTo('App\Models\Administrador\Produtos');
    }

    public function quantidades()
    {
        return $this->hasMany('App\Models\Administrador\QuantidadeMovimentacoes', 'movimentacao_id');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Models\Administrador\Usuarios');
    }
}
