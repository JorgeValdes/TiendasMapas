<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class UsuarioSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jorge',
            'email' => 'cookexx47@gmail.com',
            'email_verified_at' => Carbon::now(), //verificar el email de la persona
            'password' => Hash::make('12345678'),
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'Ignacio',
            'email' => 'jorge.valdes.01@alu.ucm.cl',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'), //formato Hash para el password
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        
    }
    
}
