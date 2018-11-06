<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Meses extends Model
{
    public function pagamentoPropinas(){
        return $this->hasMany('App\Models\Pagamentos\PagamentoPropinas');
    }
}
