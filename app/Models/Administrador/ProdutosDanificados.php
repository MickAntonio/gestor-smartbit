<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class ProdutosDanificados extends Model
{
    public function produto()
    {
        return $this->belongsTo('App\Models\Administrador\Produtos');
    }

    public function quantidade()
    {
        return $this->hasOne('App\Models\GerAdministradoral\QuantidadeDanificados');
    }
}
