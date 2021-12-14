<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

/**
 * Controller for Usuario metods
 * @author Miguel A. Tunubalá
 * @since 2021-09-17
 */
class UsuarioController extends Controller
{
    /**
     * Constructor que define el modelo usuario
     */
    public function __construct(\App\Models\AuthUser $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Display a listing of the resource.
     * @param \App\Models\Usuario Usuario model
     * @return \Illuminate\Http\Response Json response
     */
    public function index(\App\Models\AuthUser $usuario)
    {
        return $usuario->paginate(10);
    }

    /**
     * Muestre el formulario para crear un nuevo recurso.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Almacene un recurso recién creado en el almacenamiento.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $this->usuario->create($input);
        return response()->json(['data' => $input], 201);
    }

    /**
     * Muestra el recurso especificado.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $usuario = $this->usuario->find($id);
        if (!$usuario) {
            abort(404); //No encontrado
        }
        return $usuario;
    }

    /**
     * Muestre el formulario para editar el recurso especificado.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->usuario->where('id', $id)->update($input);
        return $this->usuario->find($id);
    }

    /**
     * Eliminar el recurso especificado del almacenamiento.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = $this->usuario->destroy($id);
        return ['message' => 'deleted successfully', 'id' => $usuario];
    }
}
