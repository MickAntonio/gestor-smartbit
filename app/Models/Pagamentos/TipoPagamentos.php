<?php

namespace App\Models\Pagamentos;

use Illuminate\Database\Eloquent\Model;

class TipoPagamentos extends Model
{
    public function pagamentoPrecos(){
        return $this->hasMany('App\Models\Pagamentos\PagamentoPrecos','tipo_pagamento_id');
    }
}
