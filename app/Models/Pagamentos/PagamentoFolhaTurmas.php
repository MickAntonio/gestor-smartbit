<?php

namespace App\Models\Pagamentos;

use Illuminate\Database\Eloquent\Model;

class PagamentoFolhaTurmas extends Model
{
    public function turma(){
        return $this->belongsTo('App\Models\Administrador\Turmas');
    }

    public function pagamento(){
        return $this->belongsTo('App\Models\Pagamentos\Pagamentos');
    }
}
