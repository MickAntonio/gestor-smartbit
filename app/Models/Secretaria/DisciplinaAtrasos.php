<?php

namespace App\Models\Secretaria;

use Illuminate\Database\Eloquent\Model;

class DisciplinaAtrasos extends Model
{
    public function matricula(){
        return $this->belongsTo('App\Models\Administrador\Matriculas');
    }

    public function classe(){
        return $this->belongsTo('App\Models\Administrador\Classes');
    }
    
}
