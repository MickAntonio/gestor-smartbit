<?php

namespace App\Models\Pagamentos;

use Illuminate\Database\Eloquent\Model;

class PrecoClasses extends Model
{
    public function curso(){
        return $this->belongsTo('App\Models\Administrador\Cursos');
    }

    public function classe(){
        return $this->belongsTo('App\Models\Administrador\Classes');
    }

    public function preco(){
        return $this->belongsTo('App\Models\Pagamentos\Precos');
    }

}
