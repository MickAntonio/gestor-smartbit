<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    public function contacto()
    {
        return $this->belongsTo('App\Models\General\Contacto');
    }

    public function marcacoes()
    {
        return $this->hasMany('App\Models\General\Marcacoes', 'cliente_id');
    }

}
