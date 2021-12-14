<?php

namespace App\Http\Controllers\Afiliacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Afiliado;

/**
 * Controller for afiliado metods
 * @author Miguel A. Tunubalá
 * @since 2021-09-17
 */
class ConsultasAfiliadoController extends Controller
{
    /**
     * Constructor que define el modelo afiliado
     */
    public function __construct(\App\Models\Afiliado $afiliado)
    {
        $this->afiliado = $afiliado;
    }

    /**
     * Mostrar todos los afiliados
     */
    public function buscar_afiliado(Request $request)
    {
        return $this->afiliado
            ->select(
                'persona.Identificacion_Per',
                'persona.Nombre1_Per',
                'persona.Nombre2_Per',
                'persona.Apeliido1_Per',
                'persona.Apellido2_Per',
                'persona.FechaNacimiento_Per',
                'afiliado.FechaAfiliacion_Afi',
                'afiliado.Id_Afi',
                'persona.Id_Per'
            )
            ->join('persona', 'afiliado.Id_Per', '=', 'persona.Id_Per')
            ->where('persona.Identificacion_Per', 'like', $request->Identificacion_Per. '%')
            ->where('persona.Id_PerTipId', $request->Id_PerTipId)
            ->orderBy('persona.Nombre1_Per','ASC')
            ->get();
    }
}
