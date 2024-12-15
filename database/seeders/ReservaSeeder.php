<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reserva;
use App\Models\User;
use App\Models\Mesa;
use Faker\Factory as Faker;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        foreach (range(1, 30) as $index) {
            $user = User::inRandomOrder()->first();
            
            $mesa = Mesa::inRandomOrder()->first();
            
            Reserva::create([
                'mesaId' => $mesa->id,
                'dataReserva' => $faker->dateTimeBetween('today', '+1 week'),
            ]);
        }
    }
}
