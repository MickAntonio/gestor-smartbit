<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class PagamentoServico extends Model
{
    public function usuario()
    {
        return $this->belongsTo('App\Models\Administrador\Usuarios');
    }
}
