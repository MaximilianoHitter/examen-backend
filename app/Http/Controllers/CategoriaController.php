<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Método para obtener todas las categorias
     */
    public function index()
    {
        return new CategoriaResource(Categoria::all());
    }

    /**
     * Método para guardar una categoria que se desea crear
     * nombre string(255)
     */
    public function store(StoreCategoriaRequest $request)
    {
        Categoria::create($request->validated());
        return response()->json(['data'=>'Categoría creada']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Método para actualizar la información de una categoría
     * id int()
     * nombre string(255)
     */
    public function update(UpdateCategoriaRequest $request, $categoria_id)
    {
        $categoria = Categoria::find($categoria_id);
        if($categoria != null){
            $otras_categorias = Categoria::where('nombre', $request->nombre)->get();
            if(count($otras_categorias) > 0){
                $errors = [
                    'nombre' => ['Ya existe otra categoría con ese nombre']
                ];
                return response()->json(['errors' => $errors], 422);
            }else{
                $categoria->update($request->validated());
                return response()->json(['data'=>'Categoria actualizada']); 
            }
        }else{
            $errors = [
                'general' => ['No se ha encontrado dicha categoría']
            ];
            return response()->json(['errors' => $errors], 422);
        }
    }

}
