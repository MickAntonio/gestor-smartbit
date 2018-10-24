<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    public function subcategoria()
    {
        return $this->belongsTo('App\Models\General\Subcategorias');
    }

    public function fornecedor()
    {
        return $this->belongsTo('App\Models\General\Fornecedores');
    }

    public function estoque()
    {
        return $this->hasOne('App\Models\Administrador\Estoques', 'produto_id');
    }

    public function estoques()
    {
        return $this->hasMany('App\Models\Administrador\Estoques', 'produto_id');
    }

    public function quantidades()
    {
        return $this->hasMany('App\Models\Administrador\QuantidadeCompras', 'produto_id');
    }



}
