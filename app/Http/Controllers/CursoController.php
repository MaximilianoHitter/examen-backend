<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCursoRequest;
use App\Http\Requests\UpdateCursoRequest;
use App\Http\Requests\ValidarIdPersonaRequest;
use App\Http\Resources\CursoResource;
use App\Models\Curso;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Método para obtener todos los cursos
     */
    public function index()
    {
        return new CursoResource(Curso::with('categoria')->get());
    }

    /**
     * Método para guardar un curso que se desea crear 
     * nombre string(255, unique)
     * descripcion longtext()
     * categoria_id foreingid(categorias)
     */
    public function store(StoreCursoRequest $request)
    {
        //verificar que no exista otro curso con el mismo nombre y categoria
        $cursos = Curso::where('nombre', $request->nombre)->where('categoria_id', $request->categoria_id)->get();
        if(count($cursos) > 0){
            $errors = [
                'general'=> ['Ya existe un curso con ese nombre en dicha categoría']
            ];
            return response()->json(['errors'=>$errors], 422);
        }else{
            Curso::create($request->validated());
            return response()->json(['data'=>'Curso creado']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Método para guardar un curso que se desea actualizar
     * id integer()
     * nombre string(255, unique)
     * descripcion longtext()
     * categoria_id foreingid(categorias)
     */
    public function update(UpdateCursoRequest $request, Curso $curso)
    {
        //verificar que no exista otro curso con ese nombre y dicha categoría
        $cursos = Curso::where('nombre', $request->nombre)->where('categoria_id', $request->categoria_id)->where('id', '!=', $curso->id)->get();
        if(count($cursos) > 0){
            $errors = [
                'general'=> ['Ya existe un curso con ese nombre en dicha categoría']
            ];
            return response()->json(['errors'=>$errors], 422);
        }else{
            $curso->update($request->validated());
            return response()->json(['data'=>'Curso actualizado']);
        }
    }

    /**
     * Método para obtener reportes por cada curso
     */
    public function reportePorCurso(){
        $data = [];
        $cursos = Curso::all();
        foreach ($cursos as $key => $value) {
            $tupla = [];
            $datos['masculino'] = Persona::with('cursos_personas')
            ->leftJoin('cursos_personas', 'personas.id', 'cursos_personas.persona_id')
            ->where('genero', 'masculino')
            ->where('cursos_personas.curso_id', $value->id)->count();
            $datos['femenino'] = Persona::with('cursos_personas')
            ->leftJoin('cursos_personas', 'personas.id', 'cursos_personas.persona_id')
            ->where('genero', 'femenino')
            ->where('cursos_personas.curso_id', $value->id)->count();
            $datos['suma_total_generos'] = $datos['masculino'] + $datos['femenino'];
            $datos['mayores'] = Persona::with('cursos_personas')
            ->leftJoin('cursos_personas', 'personas.id', 'cursos_personas.persona_id')
            ->where('edad', '>=', 18)
            ->where('cursos_personas.curso_id', $value->id)->count();
            $datos['menores'] = Persona::with('cursos_personas')
            ->leftJoin('cursos_personas', 'personas.id', 'cursos_personas.persona_id')
            ->where('edad', '<', 18)
            ->where('cursos_personas.curso_id', $value->id)->count();
            $datos['suma_total_edades'] = $datos['mayores'] + $datos['menores'];
            $tupla['nombre'] = $value->nombre;
            $tupla['descripcion'] = $value->descripcion;
            $tupla['id'] = $value->id;
            if($datos['suma_total_generos'] == 0){
                $tupla['porcentaje_masculino'] = 0;
                $tupla['porcentaje_femenino'] = 0;
            }else{
                $tupla['porcentaje_masculino'] = ($datos['masculino'] * 100 / $datos['suma_total_generos']);
                $tupla['porcentaje_femenino'] = ($datos['femenino'] * 100 / $datos['suma_total_generos']);
            }
            if($datos['suma_total_edades'] == 0){
                $tupla['porcentaje_mayores'] = 0;
                $tupla['porcentaje_menores'] = 0;
            }else{
                $tupla['porcentaje_mayores'] = ($datos['mayores'] * 100 / $datos['suma_total_edades']);
                $tupla['porcentaje_menores'] = ($datos['menores'] * 100 / $datos['suma_total_edades']);
            }
            $data[$value->id] = $tupla;
        }
        return new CursoResource($data);
    }

    /**
     * Método para obtener los cursos ordenados según cual fue actualizado mas recientemente
     */
    public function cursos_actualizados(){
        $cursos = Curso::with('categoria')->orderBy('updated_at', 'desc')->get();
        foreach ($cursos as $key => $value) {
            if($value->updated_at != null){
                $value->actualizado = Carbon::parse($value->updated_at)->format('d/m/Y'); 
            }
        }
        return new CursoResource($cursos);
    }

    /**
     * Método para obtener los cursos a los cuales está anotado una persona
     * id_persona
     */
    public function cursos_por_persona(ValidarIdPersonaRequest $request){
        return new CursoResource(Curso::with('categoria')
        ->leftJoin('cursos_personas', 'cursos.id', 'cursos_personas.curso_id')
        ->where('cursos_personas.persona_id', $request->persona_id)->get());
    }

}
