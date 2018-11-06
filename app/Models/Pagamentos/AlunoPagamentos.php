<?php

namespace App\Models\Pagamentos;

use Illuminate\Database\Eloquent\Model;

class AlunoPagamentos extends Model
{
    public function pagamento(){
        return $this->belongsTo('App\Models\Pagamentos\Pagamentos');
    }

    public function matricula(){
       return $this->belongsTo('App\Models\Administrador\Matriculas','matricula_id');
    }

}
