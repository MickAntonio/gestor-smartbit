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
<<<<<<< HEAD
    public function matricula(){
        return $this->hasMany('App\Models\Administrador\matriculas',"aluno_id");
    }
    public function Inscritos(){
        return $this->hasMany('App\Models\Secretaria\Candidatos');
    }
=======

>>>>>>> 14fb2b09266564ae61966aa66b0268e60f7b8c84
}
