<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class Turmas extends Model
{
    public function curso(){
        return $this->belongsTo('App\Models\Administrador\Cursos');
    }

    public function classe(){
        return $this->belongsTo('App\Models\Administrador\Classes');
    }

    public function matriculas(){
        return $this->hasMany('App\Models\Administrador\Matriculas');
    }
}
