<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mesa;
use Faker\Factory as Faker;

class MesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 15) as $index) {
            Mesa::create([
                'numero' => $index,
                'capacidade' => $faker->numberBetween(2, 8),
            ]);
        }
    }
}
