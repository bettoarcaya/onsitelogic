<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            'type'     => 'Visitante'
        ]);

        DB::table('user_types')->insert([
            'type'     => 'Exponente'
        ]);

        DB::table('user_types')->insert([
            'type'     => 'Asesor'
        ]);
    }
}
