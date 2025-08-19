<?php

namespace Database\Seeders\Vehicle;

use App\Models\Vehicle\VehicleColor;
use Illuminate\Database\Seeder;

class VehicleColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Amarillo'],
            ['name' => 'Azul Celeste'],
            ['name' => 'Azul Marino'],
            ['name' => 'Beige'],
            ['name' => 'Blanco'],
            ['name' => 'Blanco Perlado'],
            ['name' => 'Dorado'],
            ['name' => 'Gris Claro'],
            ['name' => 'Gris Oscuro'],
            ['name' => 'Marrón'],
            ['name' => 'Morado'],
            ['name' => 'Naranja'],
            ['name' => 'Negro'],
            ['name' => 'Rojo'],
            ['name' => 'Rojo Perlado'],
            ['name' => 'Rojo Vino'],
            ['name' => 'Rosado'],
            ['name' => 'Verde Claro'],
            ['name' => 'Verde Oliva'],
            ['name' => 'Verde Oscuro'],
        ];

        foreach ($data as $item) {
            VehicleColor::create($item);
        }
    }
}
