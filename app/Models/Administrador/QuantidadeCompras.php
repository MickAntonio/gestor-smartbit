<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class QuantidadeCompras extends Model
{
    public function estoque()
    {
        return $this->belongsTo('App\Models\Administrador\Estoques');
    }

    public function compra()
    {
        return $this->belongsTo('App\Models\Administrador\Compras');
    }

    public function produto()
    {
        return $this->belongsTo('App\Models\Administrador\Produtos');
    }

}
