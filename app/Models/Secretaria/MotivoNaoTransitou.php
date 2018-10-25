<?php

namespace App\Models\Secretaria;

use Illuminate\Database\Eloquent\Model;

class MotivoNaoTransitou extends Model
{
    public function matricula(){
        return $this->belongsTo('App\Models\Administrador\Matriculas');
    }
}
