<?php

use Illuminate\Database\Seeder;

class MunicipiosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $faker = Faker\Factory::create();
        $municipios = ['Michelena', 'Cordero'];
        foreach ($municipios as $municipio) {
            DB::table('municipios')->insert([ //,
                'nombre' => $municipio
            ]);
        }
    }
}
