<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categoria;
use App\Models\Curso;
use App\Models\Persona;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Categoria::factory(5)->create();
        Curso::factory(15)->create();
        Persona::factory(10)->create();
        for ($i=0; $i < 11; $i++) { 
            $this->personaCurso();
        }
    }

    private function personaCurso(){
        $faker = Factory::create();
        return DB::table('cursos_personas')->insert([
            "curso_id" => $faker->randomNumber(1, 15),
            "persona_id" => $faker->randomNumber(1, 10)
        ]);
    }
}
