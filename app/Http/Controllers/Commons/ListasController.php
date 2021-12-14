<?php

namespace App\Http\Controllers\Commons;

use App\Http\Controllers\Controller;
use App\Models\PersonaTipoIdentificacion;
use Illuminate\Http\Request;

class ListasController extends Controller
{
    /**
     * Muestra los tipos de documentos.
     * @return \Illuminate\Http\Response
     */
    public function getTipoDocumento()
    {
        return PersonaTipoIdentificacion::all();
    }
}
