<h1>Examen - Backend</h1>
<p>Herramientas utilizadas: Laragon, VSCode, PHPMyAdmin, Composer, ThunderClient, Laravel.</p>
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
      "nombre": "Quos eligendi.",
      "descripcion": "Sapiente est voluptas provident ut et laudantium praesentium.",
      "categoria_id": 2,
      "created_at": "2023-08-31T21:32:25.000000Z",
      "updated_at": "2023-08-31T21:32:25.000000Z",
      "actualizado": "31/08/2023",
      "creado": "31/08/2023",
      "categoria": {
        "id": 2,
        "nombre": "Dr. Andres Dibbert II",
        "created_at": "2023-08-31T21:32:25.000000Z",
        "updated_at": "2023-08-31T21:32:25.000000Z"
      }
    },
    {
      "id": 2,
      "nombre": "Omnis.",
      "descripcion": "Aliquam animi quis voluptas provident cupiditate dolorem qui quia exercitationem.",
      "categoria_id": 1,
      "created_at": "2023-08-31T21:32:25.000000Z",
      "updated_at": "2023-08-31T21:32:25.000000Z",
      "actualizado": "31/08/2023",
      "creado": "31/08/2023",
      "categoria": {
        "id": 1,
        "nombre": "Mr. Miller Lang V",
        "created_at": "2023-08-31T21:32:25.000000Z",
        "updated_at": "2023-08-31T21:32:25.000000Z"
      }
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
  "data": [
    {
      "nombre": "TP Rfinal",
      "descripcion": "DSAasdD",
      "id": 1,
      "porcentaje_masculino": 100,
      "porcentaje_femenino": 0,
      "porcentaje_mayores": 100,
      "porcentaje_menores": 0
    },
    {
      "nombre": "Diseño de bases de datos",
      "descripcion": "asdasdasd",
      "id": 2,
      "porcentaje_masculino": 100,
      "porcentaje_femenino": 0,
      "porcentaje_mayores": 100,
      "porcentaje_menores": 0
    },
    {
      "nombre": "IPOO",
      "descripcion": "asd",
      "id": 3,
      "porcentaje_masculino": 100,
      "porcentaje_femenino": 0,
      "porcentaje_mayores": 100,
      "porcentaje_menores": 0
    },
    {
      "nombre": "Lolo",
      "descripcion": "asdasd",
      "id": 4,
      "porcentaje_masculino": 100,
      "porcentaje_femenino": 0,
      "porcentaje_mayores": 100,
      "porcentaje_menores": 0
    }
  ]
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
{
  "data": [
    {
      "id": 1,
      "nombre": "TP Rfinal",
      "descripcion": "DSAasdD",
      "categoria_id": 1,
      "created_at": "2023-08-26T19:24:46.000000Z",
      "updated_at": "2023-08-30T23:30:49.000000Z",
      "actualizado": "30/08/2023",
      "categoria": {
        "id": 1,
        "nombre": "Programaciónes",
        "created_at": "2023-08-26T19:24:41.000000Z",
        "updated_at": "2023-08-30T23:36:09.000000Z"
      }
    },
    {
      "id": 9,
      "nombre": "Juansito",
      "descripcion": "asdasd",
      "categoria_id": 2,
      "created_at": "2023-08-30T01:36:27.000000Z",
      "updated_at": "2023-08-30T01:36:27.000000Z",
      "actualizado": "30/08/2023",
      "categoria": {
        "id": 2,
        "nombre": "SQL",
        "created_at": "2023-08-26T17:22:06.000000Z",
        "updated_at": null
      }
    },
    {
      "id": 8,
      "nombre": "C++",
      "descripcion": "Para aprender menos",
      "categoria_id": 5,
      "created_at": "2023-08-30T01:30:56.000000Z",
      "updated_at": "2023-08-30T01:30:56.000000Z",
      "actualizado": "30/08/2023",
      "categoria": {
        "id": 5,
        "nombre": "ASD",
        "created_at": "2023-08-27T00:09:43.000000Z",
        "updated_at": "2023-08-27T00:09:43.000000Z"
      }
    }
  ]
}
                </pre>
            </li>
        </ul>
    </li>
    <li>
      <ul>
        <li>Endpoint: /api/cursosPorPersona</li>
        <li>Método: POST</li>
        <li>Descripción: Se utiliza para obtener los cursos a los cuales está inscripta una persona</li>
        <li>Parámetros:
          <pre>
{
  "persona_id":5
}
          </pre>
        </li>
        <li>Output:
          <pre>
{
  "data": [
    {
      "id": 1,
      "nombre": "Qui exercitationem.",
      "descripcion": "Occaecati tempora quia tempore fugit pariatur delectus et deleniti sed suscipit.",
      "categoria_id": 2,
      "created_at": null,
      "updated_at": null,
      "curso_id": 4,
      "persona_id": 5,
      "categoria": {
        "id": 2,
        "nombre": "Dr. Andres Dibbert II",
        "created_at": "2023-08-31T21:32:25.000000Z",
        "updated_at": "2023-08-31T21:32:25.000000Z"
      }
    },
    {
      "id": 5,
      "nombre": "Quos eligendi.",
      "descripcion": "Sapiente est voluptas provident ut et laudantium praesentium.",
      "categoria_id": 2,
      "created_at": null,
      "updated_at": null,
      "curso_id": 1,
      "persona_id": 5,
      "categoria": {
        "id": 2,
        "nombre": "Dr. Andres Dibbert II",
        "created_at": "2023-08-31T21:32:25.000000Z",
        "updated_at": "2023-08-31T21:32:25.000000Z"
      }
    },
    {
      "id": 6,
      "nombre": "Omnis.",
      "descripcion": "Aliquam animi quis voluptas provident cupiditate dolorem qui quia exercitationem.",
      "categoria_id": 1,
      "created_at": null,
      "updated_at": null,
      "curso_id": 2,
      "persona_id": 5,
      "categoria": {
        "id": 1,
        "nombre": "Mr. Miller Lang V",
        "created_at": "2023-08-31T21:32:25.000000Z",
        "updated_at": "2023-08-31T21:32:25.000000Z"
      }
    },
    {
      "id": 9,
      "nombre": "Omnis.",
      "descripcion": "Aliquam animi quis voluptas provident cupiditate dolorem qui quia exercitationem.",
      "categoria_id": 1,
      "created_at": null,
      "updated_at": null,
      "curso_id": 2,
      "persona_id": 5,
      "categoria": {
        "id": 1,
        "nombre": "Mr. Miller Lang V",
        "created_at": "2023-08-31T21:32:25.000000Z",
        "updated_at": "2023-08-31T21:32:25.000000Z"
      }
    },
    {
      "id": 11,
      "nombre": "Aut.",
      "descripcion": "Sed inventore minus eum voluptatum sequi ullam.",
      "categoria_id": 3,
      "created_at": null,
      "updated_at": null,
      "curso_id": 7,
      "persona_id": 5,
      "categoria": {
        "id": 3,
        "nombre": "Jennings Kerluke",
        "created_at": "2023-08-31T21:32:25.000000Z",
        "updated_at": "2023-08-31T21:32:25.000000Z"
      }
    }
  ]
}
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
<hr>
<h3>Para correr el projecto es necesario tener instalado lo siguiente:</h3>
<ul>
    <li>PHP version mayor a 8</li>
    <li>Composer</li>
    <li>Node js</li>
    <li>MySQL/MariaDB</li>
</ul>
<p>En caso de necesitar un server, el desarrollo se llevó adelante utilizando Laragon</p>
<p>Teniendo ya el proyecto descargado se deben tener 3 cosas</p>
<ol>
    <li>Levantar el servicio del servidor que se esté utilizando</li>
    <li>Crear una base de datos con el nombre que se utiliza en el archivo .env(se debe quitar el .example del .env.example), DB_DATABASE, y luego configurar con usuario y contraseña del servicio gestor de base de datos y su puerto e ip (en caso de que esté localizado en otro sitio)</li>
    <li>
        <p>Acceder a la terminal estando sobre el root del proyecto y correr los siguientes comandos</p>
        <ul>
            <li>composer update</li>
            <li>php artisan optimize</li>
            <li>php artisan migrate</li>
            <li>php artisan serve</li>
        </ul>
    </li>
</ol>

