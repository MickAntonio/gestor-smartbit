<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    public function funcionario()
    {
        return $this->hasOne('App/Models/General/Funcionarios');
    }
}
