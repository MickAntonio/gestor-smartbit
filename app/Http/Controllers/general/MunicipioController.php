<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Municipio;

class MunicipioController extends Controller
{
    public function jsonListaDeMunicipios($provincia)
    {
        return json_encode( Municipio::where('provincia_id', $provincia)->get() );
    }
}
