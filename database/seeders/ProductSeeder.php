<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => 'K3S LONDON',
            'description' => 'Las Siroko K3s London están inspiradas en una de las ciudades más comprometidas con el deporte outdoor que existen y se sitúan a la vanguardia de las gafas de sol técnicas. ',
            'price' => 39.95,
        ]);
        DB::table('products')->insert([
            'name' => 'K3 TRIATHLON',
            'description' => 'Las nuevas Siroko K3 Triathlon están inspiradas en las disciplinas deportivas más exigentes.',
            'price' => 29.00,
        ]);

        DB::table('products')->insert([
            'name' => 'X1 LANZAROTE',
            'description' => 'Captura la fuerza de un volcán. Siente de cerca la meca del deporte. El diseño de la nueva X1 Lanzarote favorece una evacuación perfecta del sudor y una circulación óptima del aire.',
            'price' => 59.95,
        ]);
    }
}
