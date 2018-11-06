<?php

namespace App\Models\Pagamentos;

use Illuminate\Database\Eloquent\Model;

class Propinas extends Model
{   
    public function pagamento(){
        return $this->belongsTo('App\Models\Pagamentos\PagamentoPropinas','pagamento_propina_id');
    }

    public function preco(){
        return $this->belongsTo('App\Models\Pagamentos\PrecoClasses','preco_classe_id');
    }

    public function mes(){
        return $this->belongsTo('App\Models\General\Meses');
    }
}