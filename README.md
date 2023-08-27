<h1>Examen - Backend</h1>
<br>
<h3>Descripción de Endpoints</h3>
<h5>Controlador Categorías</h5>
<ul>
    <li>
        <ul>
            <li>Endpoint: /api/categoria</li>
            <li>Método: GET</li>
            <li>Descripción: Devuelve todas las categorías</li>
            <li>Parámetros: No posee</li>
            <li>Output: 
                <pre>                    
{
  "data": [
    {
      "id": 1,
      "nombre": "Programacion",
      "created_at": "2023-08-26T19:24:41.000000Z",
      "updated_at": "2023-08-26T19:24:41.000000Z"
    },
    {
      "id": 2,
      "nombre": "SQL",
      "created_at": "2023-08-26T17:22:06.000000Z",
      "updated_at": null
    }
  ]
}
               </pre>
            </li>
        </ul>
    </li>
    <li>
        <ul>
            <li>Endpoint: /api/categoria</li>
            <li>Método: POST</li>
            <li>Descripción: Se utiliza para crear una categoría</li>
            <li>Parámetros: 
                <pre>
{
  "nombre":"Programacion"
}
                </pre>
            </li>
            <li>Output:
                <pre>
{
  "data": "Categoría creada"
}
                </pre>
            </li>
            <li>Rules:
                <pre>
[
    'nombre' => 'required|unique:categorias,nombre'
]
                </pre>
            </li>
            <li>Errores:
               <pre>
{
  "message": "El campo nombre ya ha sido registrado.",
  "errors": {
    "nombre": [
      "El campo nombre ya ha sido registrado."
    ]
  }
}
               </pre> 
            </li>
        </ul>
    </li>
    <li>
        <ul>
            <li>Endpoint: /api/categoria/{id}</li>
            <li>Método: PUT</li>
            <li>Descripción: Se utiliza para actualizar la información de una categoría</li>
            <li>Parámetros:
                <pre>
{
  "nombre":"TP final",
  "descripcion":"ASD",
  "categoria_id": 2
}
                </pre>
            </li>
            <li>Output:
                <pre>
{
  "data": "Categoría actualizada"
}
                </pre>
            </li>
            <li>Rules:
                <pre>
[
    'nombre' => ['required']
]
                </pre>
            </li>
            <li>Errores:
                <pre>
{
  "errors": {
    "general": [
      "No se ha encontrado dicha categoría"
    ]
  }
}
{
  "errors": {
    "nombre": [
      "Ya existe otra categoría con ese nombre"
    ]
  }
}

                </pre>
            </li>
        </ul>
    </li>
    
</ul>

<hr>

<h5>Controlador Curso</h5>

<ul>
    <li>
        <ul>
            <li>Endpoint: /api/curso</li>
            <li>Método: GET</li>
            <li>Descripción: Devuelve todas los cursos</li>
            <li>Parámetros: No posee</li>
            <li>Output:
                <pre>
{
  "data": [
    {
      "id": 1,
      "nombre": "TP final",
      "descripcion": "ASD",
      "categoria_id": 1,
      "created_at": "2023-08-26T19:24:46.000000Z",
      "updated_at": "2023-08-26T19:24:46.000000Z"
    },
    {
      "id": 2,
      "nombre": "Diseño de bases de datos",
      "descripcion": "asdasdasd",
      "categoria_id": 2,
      "created_at": "2023-08-26T17:22:27.000000Z",
      "updated_at": null
    }
  ]
}
                </pre>
            </li>
        </ul>
    </li>
    <li>
        <ul>
            <li>Endpoint: /api/curso</li>
            <li>Método: POST</li>
            <li>Descripcion: Se utiliza para crear un curso</li>
            <li>Parámetros:
                <pre>
{
  "nombre":"TP final",
  "descripcion":"Curso de prueba",
  "categoria_id": 2
}
                </pre>
            </li>
            <li>Output:
                <pre>
{
  "data": "Curso creado"
}
                </pre>
            </li>
            <li>Rules:
                <pre>
[
    'nombre' => 'required|min:3|max:250',
    'descripcion' => 'required|min:3',
    'categoria_id' => 'required|exists:categorias,id'
]
                </pre>
            </li>
            <li>Errores:
                <pre>
{
  "message": "El campo nombre es obligatorio. (y 2 errores más)",
  "errors": {
    "nombre": [
      "El campo nombre es obligatorio."
    ],
    "descripcion": [
      "El campo descripcion es obligatorio."
    ],
    "categoria_id": [
      "El campo categoria id es obligatorio."
    ]
  }
}
{
  "errors": {
    "general": [
      "Ya existe un curso con ese nombre en dicha categoría"
    ]
  }
}
                </pre>
            </li>
        </ul>
    </li>
    <li>
        <ul>
            <li>Endpoint: /api/curso/{id}</li>
            <li>Método: PUT</li>
            <li>Descripción: Se utiliza para actualizar un curso</li>
            <li>Parámetros:
                <pre>
{
  "nombre":"TP final",
  "descripcion":"Curso de prueba",
  "categoria_id":2
}
                </pre>
            </li>
            <li>Output:
                <pre>
{
  "data": "Curso actualizado"
}
                </pre>
            </li>
            <li>Rules:
                <pre>
[
    'nombre' => 'required|min:3|max:250',
    'descripcion' => 'required|min:3',
    'categoria_id' => 'required|exists:categorias,id'
]
                </pre>
            </li>
            <li>Errores:
                <pre>
{
  "message": "El campo nombre es obligatorio. (y 2 errores más)",
  "errors": {
    "nombre": [
      "El campo nombre es obligatorio."
    ],
    "descripcion": [
      "El campo descripcion es obligatorio."
    ],
    "categoria_id": [
      "El campo categoria id es obligatorio."
    ]
  }
}
{
  "errors": {
    "general": [
      "Ya existe un curso con ese nombre en dicha categoría"
    ]
  }
}
                </pre>
            </li>
        </ul>
    </li>
    <li>
        <ul>
            <li>Endpoint: /api/reportePorCurso</li>
            <li>Método: GET</li>
            <li>Descripción: Se utiliza para obtener, por cada curso, la información del mismo y también la cantidad de masculinos, femeninos, ambos sexos, mayores, menores y total de personas en cada curso.</li>
            <li>Parámetros: No posee</li>
            <li>Output:
                <pre>
{
  "1": {
    "reporte": {
      "masculino": 1,
      "femenino": 1,
      "suma_total_generos": 2,
      "mayores": 2,
      "menores": 0,
      "suma_total_edades": 2
    },
    "info": {
      "id": 1,
      "nombre": "TP REfinal",
      "descripcion": "Prueba",
      "categoria_id": 1,
      "created_at": "2023-08-26T19:24:46.000000Z",
      "updated_at": "2023-08-26T22:14:54.000000Z"
    }
  },
  "2": {
    "reporte": {
      "masculino": 0,
      "femenino": 1,
      "suma_total_generos": 1,
      "mayores": 1,
      "menores": 0,
      "suma_total_edades": 1
    },
    "info": {
      "id": 2,
      "nombre": "Diseño de bases de datos",
      "descripcion": "Prueba",
      "categoria_id": 2,
      "created_at": "2023-08-26T17:22:27.000000Z",
      "updated_at": null
    }
  },
  "3": {
    "reporte": {
      "masculino": 0,
      "femenino": 1,
      "suma_total_generos": 1,
      "mayores": 1,
      "menores": 0,
      "suma_total_edades": 1
    },
    "info": {
      "id": 3,
      "nombre": "IPOO",
      "descripcion": "Prueba",
      "categoria_id": 1,
      "created_at": "2023-08-26T17:38:27.000000Z",
      "updated_at": null
    }
  }
}
                </pre>
            </li>
        </ul>
    </li>
    <li>
        <ul>
            <li>Endpoint: /api/cursos-actualizados</li>
            <li>Método: GET</li>
            <li>Descripción: Se utiliza para obtener los cursos ordenados desde el actualizado mas recientemente hasta el último</li>
            <li>Parámetros: No posee</li>
            <li>Output:
                <pre>
[
  {
    "id": 1,
    "nombre": "TP Del final",
    "descripcion": "Prueba",
    "categoria_id": 1,
    "created_at": "2023-08-26T19:24:46.000000Z",
    "updated_at": "2023-08-26T22:14:54.000000Z"
  },
  {
    "id": 6,
    "nombre": "TP final",
    "descripcion": "Prueba",
    "categoria_id": 2,
    "created_at": "2023-08-26T22:10:29.000000Z",
    "updated_at": "2023-08-26T22:10:29.000000Z"
  },
  {
    "id": 2,
    "nombre": "Diseño de bases de datos",
    "descripcion": "Prueba",
    "categoria_id": 2,
    "created_at": "2023-08-26T17:22:27.000000Z",
    "updated_at": null
  },
  {
    "id": 3,
    "nombre": "IPOO",
    "descripcion": "Prueba",
    "categoria_id": 1,
    "created_at": "2023-08-26T17:38:27.000000Z",
    "updated_at": null
  }
]
                </pre>
            </li>
        </ul>
    </li>
</ul>

<hr>

<h5>Controlador Persona</h5>

<ul>
    <li>
        <ul>
            <li>Endpoint: /api/persona</li>
            <li>Método: GET</li>
            <li>Descripción: Se utiliza para obtener todas las personas</li>
            <li>Parámetros: No posee</li>
            <li>Output:
                <pre>
{
  "data": [
    {
      "id": 1,
      "nombre": "Pepito modificado",
      "apellido": "del campo",
      "dni": 38258043,
      "genero": "femenino",
      "edad": 52,
      "created_at": "2023-08-26T16:38:35.000000Z",
      "updated_at": "2023-08-26T19:33:09.000000Z"
    },
    {
      "id": 2,
      "nombre": "Juanito",
      "apellido": "Pipon",
      "dni": 32659845,
      "genero": "masculino",
      "edad": 25,
      "created_at": "2023-08-26T17:21:09.000000Z",
      "updated_at": null
    },
    {
      "id": 3,
      "nombre": "Carlos",
      "apellido": "Saul",
      "dni": 4578124,
      "genero": "masculino",
      "edad": 55,
      "created_at": "2023-08-26T17:21:09.000000Z",
      "updated_at": null
    }
  ]
}
                </pre>
            </li>
        </ul>
    </li>
    <li>
        <ul>
            <li>Endpoint: /api/persona</li>
            <li>Método: POST</li>
            <li>Descripción: Se utiliza para crear una persona</li>
            <li>Parámetros:
                <pre>
{
  "nombre":"Pepe",
  "apellido":"Jonas",
  "dni":38258043,
  "genero":"masculino",
  "edad":20
}
                </pre>
            </li>
            <li>Output:
                <pre>
{
  "data": "Persona creada"
}
                </pre>
            </li>
            <li>Rules:
                <pre>
[
    'nombre' => 'required',
    'apellido' => 'required',
    'dni' => 'required|numeric|gt:1000000|lt:999999999|unique:personas,dni',
    'genero' => 'required|in:masculino,femenino',
    'edad' => 'required|numeric'
]
                </pre>
            </li>
            <li>Errores:
                <pre>
{
  "message": "El campo nombre es obligatorio. (y 4 errores más)",
  "errors": {
    "nombre": [
      "El campo nombre es obligatorio."
    ],
    "apellido": [
      "El campo apellido es obligatorio."
    ],
    "dni": [
      "El campo dni es obligatorio."
    ],
    "genero": [
      "El campo genero es obligatorio."
    ],
    "edad": [
      "El campo edad es obligatorio."
    ]
  }
}
{
  "message": "El campo dni ya ha sido registrado.",
  "errors": {
    "dni": [
      "El campo dni ya ha sido registrado."
    ]
  }
}
                </pre>
            </li>
        </ul>
    </li>
    <li>
        <ul>
            <li>Endpoint: /api/persona/{id}</li>
            <li>Método: PUT</li>
            <li>Descripción: Se utiliza para actualizar los datos de una persona</li>
            <li>Parámetros:
                <pre>
{
  "nombre":"Pepito modificado",
  "apellido":"del campo",
  "dni":38258044,
  "genero":"femenino",
  "edad":52
}
                </pre>
            </li>
            <li>Output:
                <pre>
{
  "data": "Persona actualizada"
}
                </pre>
            </li>
            <li>Rules:
                <pre>
[
    'nombre' => 'required',
    'apellido' => 'required',
    'dni' => ['required','numeric', 'gt:1000000', 'lt:999999999', 'unique:personas,dni,'.$this->persona->id],
    'genero' => 'required|in:masculino,femenino',
    'edad' => 'required|numeric'
]
                </pre>
            </li>
            <li>Errores:
                <pre>
{
  "message": "El campo nombre es obligatorio. (y 4 errores más)",
  "errors": {
    "nombre": [
      "El campo nombre es obligatorio."
    ],
    "apellido": [
      "El campo apellido es obligatorio."
    ],
    "dni": [
      "El campo dni es obligatorio."
    ],
    "genero": [
      "El campo genero es obligatorio."
    ],
    "edad": [
      "El campo edad es obligatorio."
    ]
  }
}
{
  "message": "El campo dni ya ha sido registrado.",
  "errors": {
    "dni": [
      "El campo dni ya ha sido registrado."
    ]
  }
}
                </pre>
            </li>
        </ul>
    </li>
    <li>
        <ul>
            <li>Endpoint: /api/asign</li>
            <li>Método: POST</li>
            <li>Descripción: Se utiliza para anotar a una persona a un curso</li>
            <li>Parámetros:
                <pre>
{
  "persona_id":1,
  "curso_id":1
}
                </pre>
            </li>
            <li>Output:
                <pre>
{
  "data": "Persona añadida al curso"
}
                </pre>
            </li>
            <li>Rules:
                <pre>
[
    "persona_id" => ['required', 'exists:personas,id'],
    "curso_id" => ['required', "exists:cursos,id"]
]
                </pre>
            </li>
            <li>Errores:
                <pre>
{
  "errors": {
    "general": [
      "La persona ya se encuentra inscripta a dicho curso"
    ]
  }
}
{
  "errors": {
    "general": [
      "La persona se ha inscripto a 3 cursos de dicha categoría"
    ]
  }
}
                </pre>
            </li>
        </ul>
    </li>
</ul>

