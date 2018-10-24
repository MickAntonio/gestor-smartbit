<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Fornecedores extends Model
{
    public function contacto()
    {
        return $this->belongsTo('App\Models\General\Contacto');
    }

    public function endereco()
    {
       return $this->belongsTo('App\Models\General\Endereco');
    }
}
