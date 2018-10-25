<?php

namespace App\Models\Pagamentos;

use Illuminate\Database\Eloquent\Model;

class PagamentoPrecos extends Model
{
    public function preco(){
        return $this->belongsTo('App\Models\Pagamentos\Precos');
    }

    public function tipoPagamento(){
        return $this->belongsTo('App\Models\Pagamentos\TipoPagamentos', 'tipo_pagamento_id');
    }
}
