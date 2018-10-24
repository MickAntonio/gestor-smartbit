<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class Pagamentos extends Model
{
    public function servicos(){
        return $this->belongsToMany('App\Models\General\Servicos', 'servicos_pagamentos', 'pagamento_id', 'servico_id');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Models\General\Clientes');
    }

}
