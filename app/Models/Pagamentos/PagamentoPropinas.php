<?php

namespace App\Models\Pagamentos;

use Illuminate\Database\Eloquent\Model;

class PagamentoPropinas extends Model
{    
    public function matricula(){
        return $this->belongsTo('App\Models\Administrador\Matriculas');
    }

    public function propinas(){
        return $this->hasMany('App\Models\Pagamentos\Propinas','pagamento_propina_id');
    }

    public function user(){
        return $this->belongsTo('App\Users');
    }

}