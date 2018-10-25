<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    public function turmas(){
        return $this->hasMany('App\Models\Administrador\Turmas');
    }

    public function alunos(){
        return $this->hasMany('App\Models\Administrador\Alunos');
    }
}
