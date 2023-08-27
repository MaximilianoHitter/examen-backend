<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "descripcion",
        "categoria_id"
    ];

    public function categoria() : BelongsTo{
        return $this->belongsTo(Categoria::class);
    }

    public function personas() : BelongsToMany{
        return $this->belongsToMany(Persona::class, 'cursos_personas');
    }
}
