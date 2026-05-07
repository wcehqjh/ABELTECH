<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'        => 'ASUS ROG Strix G15 Gaming',
                'category'    => 'laptop',
                'price'       => 14990,
                'old_price'   => 17500,
                'brand'       => 'ASUS',
                'description' => 'RTX 4060, Ryzen 9, 16 Go RAM, 512 Go SSD NVMe',
                'stock'       => 5,
                'is_new'      => true,
                'is_promo'    => true,
                'is_active'   => true,
                'specs'       => ['GPU'=>'RTX 4060','CPU'=>'Ryzen 9 7940H','RAM'=>'16 Go DDR5','SSD'=>'512 Go NVMe','Écran'=>'15.6" 144Hz FHD'],
            ],
            [
                'name'        => 'Dell XPS 15 Creator',
                'category'    => 'laptop',
                'price'       => 19900,
                'brand'       => 'Dell',
                'description' => 'Intel Core i7-13700H, 32 Go RAM, 1 To SSD, écran OLED 4K',
                'stock'       => 3,
                'is_new'      => true,
                'is_active'   => true,
                'specs'       => ['CPU'=>'Intel i7-13700H','RAM'=>'32 Go DDR5','SSD'=>'1 To NVMe','Écran'=>'15.6" OLED 4K'],
            ],
            [
                'name'        => 'PC Gamer Titan RTX 4070',
                'category'    => 'gaming',
                'price'       => 24990,
                'old_price'   => 27000,
                'brand'       => 'Abeltech',
                'description' => 'Config gaming haut de gamme assemblée sur mesure — RTX 4070 Ti, i9-13900K',
                'stock'       => 2,
                'is_promo'    => true,
                'is_active'   => true,
                'specs'       => ['GPU'=>'RTX 4070 Ti 12Go','CPU'=>'Intel i9-13900K','RAM'=>'32 Go DDR5 6000MHz','SSD'=>'2 To NVMe','Boîtier'=>'NZXT H9 Elite'],
            ],
            [
                'name'        => 'Sony PlayStation 5 Disc',
                'category'    => 'console',
                'price'       => 7490,
                'brand'       => 'Sony',
                'description' => 'Console nouvelle génération 4K, 120 FPS, SSD ultra-rapide 825 Go',
                'stock'       => 8,
                'is_new'      => true,
                'is_active'   => true,
            ],
            [
                'name'        => 'Samsung 65" Neo QLED 4K',
                'category'    => 'tv',
                'price'       => 12990,
                'old_price'   => 15000,
                'brand'       => 'Samsung',
                'description' => 'Smart TV 65", Neo QLED 4K, 120Hz, HDR2000, Gaming Mode',
                'stock'       => 4,
                'is_promo'    => true,
                'is_active'   => true,
            ],
            [
                'name'        => 'Logitech G Pro X Superlight 2',
                'category'    => 'accessory',
                'price'       => 990,
                'brand'       => 'Logitech',
                'description' => 'Souris gaming sans fil ultra-légère 60g, capteur HERO 25K',
                'stock'       => 15,
                'is_new'      => true,
                'is_active'   => true,
            ],
            [
                'name'        => 'Crucial RAM 32 Go DDR5 6000MHz',
                'category'    => 'component',
                'price'       => 1490,
                'brand'       => 'Crucial',
                'description' => 'Kit 2×16 Go DDR5 6000MHz CL36, compatible AMD Expo & Intel XMP 3.0',
                'stock'       => 10,
                'is_active'   => true,
            ],
            [
                'name'        => 'Razer BlackShark V2 Pro 2023',
                'category'    => 'accessory',
                'price'       => 2290,
                'brand'       => 'Razer',
                'description' => 'Casque gaming sans fil 7.1, son THX Spatial, micro détachable',
                'stock'       => 7,
                'is_active'   => true,
            ],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }
    }
}