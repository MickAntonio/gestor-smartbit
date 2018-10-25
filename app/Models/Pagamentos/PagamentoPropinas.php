<?php

namespace App\Models\Pagamentos;

use Illuminate\Database\Eloquent\Model;

class PagamentoPropinas extends Model
{
    
    public function pagamento(){
        return $this->belongsTo('App\Models\Pagamentos\Pagamentos');
    }

    public function matricula(){
        return $this->belongsTo('App\Models\Administrador\Matriculas');
    }

    public function mes(){
        return $this->belongsTo('App\Models\General\Meses');
    }
}
