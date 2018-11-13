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
    public function matricula(){
        return $this->hasMany('App\Models\Administrador\matriculas',"aluno_id");
    }
    public function Inscritos(){
        return $this->hasMany('App\Models\Secretaria\Candidatos');
    }

    public function saldo(){
        return $this->hasOne('App\Models\Pagamentos\Saldo', 'aluno_id');
    }

}
