<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class QuantidadeVendas extends Model
{
    public function estoque()
    {
        return $this->belongsTo('App\Models\Administrador\Estoques');
    }

    public function venda()
    {
        return $this->belongsTo('App\Models\Administrador\Vendas');
    }

    public function produto()
    {
        return $this->belongsTo('App\Models\Administrador\Produtos');
    }

}
