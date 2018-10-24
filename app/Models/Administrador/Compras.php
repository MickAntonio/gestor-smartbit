<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
   
    public function fornecedor()
    {
        return $this->belongsTo('App\Models\General\Fornecedores');
    }

    public function quantidades()
    {
        return $this->hasMany('App\Models\Administrador\QuantidadeCompras', 'compra_id');
    }
}
