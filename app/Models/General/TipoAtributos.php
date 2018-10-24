<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class TipoAtributos extends Model
{
    public function atributos()
    {
        return $this->hasOne('App\Models\General\Atributos');
    }
}
