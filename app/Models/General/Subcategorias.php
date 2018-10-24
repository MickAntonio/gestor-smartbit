<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Subcategorias extends Model
{
    public function categoria()
    {
        return $this->belongsTo('App\Models\General\Categorias');
    }

    public function produtos()
    {
        return $this->hasOne('App\Models\Administrador\Produtos');
    }
}
