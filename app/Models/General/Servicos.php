<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Servicos extends Model
{
    public function pagamentos(){
        return $this->belongsToMany('App\Models\Administrador\Pagamentos', 'servicos_pagamentos', 'pagamento_id', 'servico_id');
    }
}
