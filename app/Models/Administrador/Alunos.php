<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    public function candidato(){
        return $this->belongsTo('App\Models\Secretaria\Candidatos');
    }

    public function curso(){
        return $this->belongsTo('App\Models\Administrador\Cursos');
    }
}
