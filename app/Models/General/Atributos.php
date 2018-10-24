<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Atributos extends Model
{
    public function tipo_atributo()
    {
        return $this->belongsTo('App\Models\General\TipoAtributos');
    }

    public function produto_variacoes()
    {
        return $this->hasMany('App\Models\Administrador\ProdutoVariacoes');
    }

}
