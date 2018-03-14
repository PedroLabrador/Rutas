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

        DB::table('municipios')->insert([ //,
            'nombre' => 'Michelena',
            'hora' => '07:10 PM'
        ]);
    }
}
