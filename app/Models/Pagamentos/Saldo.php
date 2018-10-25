<?php

namespace App\Models\Pagamentos;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    public function aluno(){
        return $this->belongsTo('App\Models\Administrador\Alunos');
    }
}
