<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class Meses extends Model
{
    public function pagamentoPropinas(){
        return $this->hasMany('App\Models\Pagamentos\PagamentoPropinas');
    }
}
