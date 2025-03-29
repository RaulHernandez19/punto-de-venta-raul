<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = Producto::factory()->count(5)->create();


        $imagenes = [
            'laptop.jpg',
            'smartwatch.jpg',
            'auriculares.jpg',
            'camara.jpg',
            'altavoz.jpg'
        ];

        foreach ($productos as $index => $producto) {
            $nombreImagen = $imagenes[$index];

            $producto->update([

                'image_path' => 'productos/' . $nombreImagen
            ]);
        }
    }
}
