<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    public function subcategorias()
    {
        return $this->hasOne('App\Models\General\Subcategorias');
    }
}
