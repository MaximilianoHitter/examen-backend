<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonaCursoRequest;
use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use App\Http\Resources\PersonaResource;
use App\Models\Categoria;
use App\Models\Curso;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    /**
     * Método para obtener todas las personas.
     */
    public function index()
    {
        return new PersonaResource(Persona::all());
    }

    /**
     * Método para guardar una persona que se desea crear
     * nombre string(255)
     * apellido string(255)
     * dni integer(unique, 1.000.000<x<999.999.999)
     * genero string(masculino/femenino)
     * edad integer(18<=x)
     */
    public function store(StorePersonaRequest $request)
    {
        Persona::create($request->validated());
        return response()->json(['data'=>'Persona creada']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Método para actualizar la información de una persona ya creada
     * id integer()
     * nombre string(255)
     * apellido(255)
     * dni integer(unique, 1.000.000<x<999.999.999)
     * genero string(masculino/femenino)
     * edad integer(18<=x)
     */
    public function update(UpdatePersonaRequest $request, Persona $persona)
    {
        $persona->update($request->validated());
        return response()->json(['data'=>'Persona actualizada']);
    }

    /**
     * Método para asignar personas a cursos 
     * persona_id foreignId(personas)
     * curso_id foreignId(cursos)
     */
    public function asign(StorePersonaCursoRequest $request)
    {
        //falta validación de a cuantos cursos de esa misma categoría está inscripta la persona
        $curso = Curso::find($request->curso_id);
        $persona = Persona::find($request->persona_id);
        $categoria = Categoria::find($curso->categoria_id);
        //verificacion de si ya se inscribió al curso 
        $en_curso = $persona->cursos()->where('curso_id', $request->curso_id)->exists();
        if ($en_curso == 1) {
            $errors = [
                'general'=>['La persona ya se encuentra inscripta a dicho curso']
            ];
            return response()->json(['errors'=> $errors], 422);
        } else {
            //verificación de si ya está inscripto a 3 cursos de la misma categoría
            $cursos_de_categoria = Curso::where('categoria_id', $categoria->id)->leftJoin('cursos_personas', 'cursos.id', 'cursos_personas.curso_id')->where('cursos_personas.persona_id', $persona->id)->count();
            //return $cursos_de_categoria;
            if ($cursos_de_categoria > 2) {
                //la persona se ha inscripto a 3 cursos de la misma categoria
                $errors = [
                    'general'=>['La persona se ha inscripto a 3 cursos de dicha categoría']
                ];
                return response()->json(['errors'=>$errors], 422);
            } else {
                $curso = Curso::find($request->curso_id);
                $persona->cursos()->attach($curso);
                return response()->json(['data'=>'Persona añadida al curso']);
            }
 
        }
    }

}
