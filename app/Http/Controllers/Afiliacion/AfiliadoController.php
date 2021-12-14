<?php

namespace App\Http\Controllers\Afiliacion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller for afiliado metods
 * @author Miguel A. Tunubalá
 * @since 2021-09-17
 */
class AfiliadoController extends Controller
{
    /**
     * Constructor que define el modelo afiliado
     */
    public function __construct(\App\Models\Afiliado $afiliado)
    {
        $this->afiliado = $afiliado;
    }

    public function index(\App\Models\Afiliado $afiliado)
    {
        return $afiliado->paginate(10);
    }
    /**
     * Almacene un recurso recién creado en el almacenamiento.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $this->afiliado->create($input);
        return response()->json(['data' => $input], 201);
    }

    /**
     * Muestra el recurso especificado.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $afiliado = $this->afiliado->find($id);
        if (!$afiliado) {
            abort(404); //No encontrado
        }
        return $afiliado;
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->afiliado->where('Id_Afi', $id)->update($input);
        return $this->afiliado->find($id);
    }

    /**
     * Eliminar el recurso especificado del almacenamiento.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $afiliado = $this->afiliado->destroy($id);
        return ['message' => 'Eliminado con éxito', 'id' => $afiliado];
    }
}
