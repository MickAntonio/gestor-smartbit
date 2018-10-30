<?php

namespace App\Models\secretaria;

use Illuminate\Database\Eloquent\Model;

class Matriculas extends Model
{
    public function aluno(){
        return $this->belongsTo('App\Models\Administrador\Alunos');
    }

    public function turma(){
        return $this->belongsTo('App\Models\Administrador\Turmas');
    }

    public function pagamentoPropinas(){
        return $this->hasMany('App\Models\Pagamentos\PagamentoPropinas');
    }

    public function motivoNaoTransitou(){
        return $this->hasOne('App\Models\Secretaria\MotivoNaoTransitou');
    }

    public function disciplinaAtrasos(){
        return $this->hasMany('App\Models\Secretaria\DisciplinaAtrasos');
    }
}
