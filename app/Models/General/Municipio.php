<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    public function provincia(){
        return $this->belongsTo('App\Models\General\Provincia');
    }

    public function endereco(){
        return $this->hasOne('App\Models\General\Endereco');
    }
}
