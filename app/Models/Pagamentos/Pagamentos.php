<?php

namespace App\Models\Pagamentos;

use Illuminate\Database\Eloquent\Model;

class Pagamentos extends Model
{
    public function tipoPagamento(){
        return $this->belongsTo('App\Models\Pagamentos\TipoPagamentos', 'tipo_pagamento_id');
    }

    public function user(){
        return $this->belongsTo('App\Users');
    }
}
