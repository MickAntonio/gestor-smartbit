<?php

namespace App\Models\Secretaria;

use Illuminate\Database\Eloquent\Model;

class Candidatos extends Model
{

    public function municipio(){
        return $this->belongsTo('App\Models\General\Municipio');
    }

    public function escolaAnterior(){
        return $this->belongsTo('App\Models\Secretaria\Escola_Anterior','escola_anterior_id');
    }

    public function aluno(){
        return $this->hasOne('App\Models\Administrador\Alunos','candidato_id');
    }

}
