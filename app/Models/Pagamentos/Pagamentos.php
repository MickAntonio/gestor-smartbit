<?php

namespace App\Models\Pagamentos;

use Illuminate\Database\Eloquent\Model;

class Pagamentos extends Model
{
    public function pagamentoPreco(){
        return $this->belongsTo('App\Models\Pagamentos\PagamentoPrecos', 'pagamento_preco_id');
    }

    public function user(){
        return $this->belongsTo('App\Users');
    }

    public function alunoPagamento(){
        return $this->hasOne('App\Models\Pagamentos\AlunoPagamentos');
    }

}
