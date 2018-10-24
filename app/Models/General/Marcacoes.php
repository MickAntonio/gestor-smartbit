<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Marcacoes extends Model
{
    public function cliente()
    {
        return $this->belongsTo('App\Models\General\Clientes');
    }
}
