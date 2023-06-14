<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nombre' => 'Jose',
                'email' => 'jchilelaime38@gmail.com',
                'password' => Hash::make('12345'),
            ],
            [
                'nombre' => 'Fabricio',
                'email' => 'fabricio@gmail.com',
                'password' => Hash::make('12345'),
            ],
            [
                'nombre' => 'Gustavo',
                'email' => 'gustavo@gmail.com',
                'password' => Hash::make('12345'),
            ]     
        ]);
    }
}
