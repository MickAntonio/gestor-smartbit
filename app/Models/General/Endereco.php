<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public function municipio(){
        return $this->belongsTo('App\Models\General\Municipio');
    }

    public function funcionario()
    {
        return $this->hasOne('App/Models/General/Funcionarios');
    }
    
}
