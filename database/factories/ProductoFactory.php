<?php

namespace Database\Factories;

use App\Models\Proveedor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'name' => $this->faker->unique()->randomElement([
            'Laptop Ultradelgada 14" 8GB RAM 512GB SSD',
            'Smartwatch Resistente al Agua con GPS',
            'Auriculares Inalámbricos Cancelación Ruido',
            'Cámara DSLR 24MP Kit Inicio',
            'Altavoz Bluetooth Portátil 360°'
        ]),
        'descripcion' => $this->faker->randomElement([
            'Ultraportátil con procesador i5 de 11va generación, ideal para trabajo y multimedia',
            'Monitoriza tu actividad física con sensor cardíaco y resistencia hasta 50 metros',
            'Sonido envolvente con 30h de autonomía y tecnología de cancelación activa de ruido',
            'Kit profesional con lente 18-55mm y doble lente para fotografía creativa',
            'Potente sonido estéreo con conectividad NFC y resistencia a salpicaduras'
        ]),
        'price' => $this->faker->randomFloat(2, 150, 800),
        'public_price' => $this->faker->randomFloat(2, 200, 1000),
        'stock' => $this->faker->numberBetween(5, 50),
        'image_path' => $this->faker->randomElement([
            'productos/laptop.jpg',
            'productos/smartwatch.jpg',
            'productos/auriculares.jpg',
            'productos/camara.jpg',
            'productos/altavoz.jpg'
        ]),
        'proveedor_id' => Proveedor::factory(),
    ];
}
}
