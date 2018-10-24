<?php

namespace App\Models\Administrador;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    public function vendas()
    {
        return $this->hasOne('App\Models\Administrador\Vendas');
    }

    public function movimentacoes()
    {
        return $this->hasOne('App\Models\Administrador\Movimentacoes');
    }

    public function pagamento_servicos()
    {
        return $this->hasOne('App\Models\Administrador\Pagamentos_Servicos');
    }

}
