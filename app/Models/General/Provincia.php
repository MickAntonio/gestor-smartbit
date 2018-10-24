<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    public function municipios(){
        return $this->hasMany('App\Models\General\Municipio');
    }
}
