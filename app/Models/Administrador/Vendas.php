<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    public function produto()
    {
        return $this->belongsTo('App\Models\Administrador\Produto');
    }

    public function quantidades()
    {
        return $this->hasMany('App\Models\Administrador\QuantidadeVendas', 'venda_id');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Models\Administrador\Usuarios');
    }
}
