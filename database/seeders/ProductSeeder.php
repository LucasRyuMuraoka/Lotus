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

        // 'Entrada', 'Combinados', 'Sashimi', 'Temaki', 'Sobremesas', 'Bebidas'
        // Name - Description - Price - Stock - URL - Active - Discount - Category
        $products = [
            ['Salada Nagayama', 'Mix de folhas verdes, kani e salmão', 57.00, 99, 'https://i.postimg.cc/qqGGPQZQ/Salada-Nagayama.jpg', true, 0, 1],
            ['Couver Especial', 'Mix de folhas com molho da casa', 35.00, 99, 'https://i.postimg.cc/VNybFnKN/mix-de-folhas.jpg', true, 0, 1],
            ['Naga Salad Tuna', 'Mix de folhas verdes, kani e atum', 67.00, 99, 'https://i.postimg.cc/Wz4D4n15/mix-folhas-atum-kani.jpg', true, 0, 1],
            ['Naga Premium 1', '3 Fatias de salmão selado, 3 fatias de atum, 3 fatias de peixe branco do dia, 3 fatias de barriga de salmão, 1 unidade de sushi de polvo temperado, 1 unidade de sushi de salmão selado, 1 unidade de sushi de atum, 1 unidade de sushi de peixe branco do dia, 1 unidade de jô de atum com wakame, 1 unidade de sushi de massago.', 179.00, 99, 'https://i.postimg.cc/T2t4kqBQ/naga-premium1.png', true, 0, 2],
            ['Naga Case 1', '08 Fatias de carpaccio de salmão, 03 fatias de salmão, 02 fatias de atum, 01 dupla de batera de salmão, 01 sushi salmão selado, 01 sushi de atum selado, 01 sushi jô salmão e 04 uramaki ebiten.', 159.00, 99, 'https://i.postimg.cc/vmBHfBsm/naga-case1.jpg', true, 0, 2],
            ['Sushi e Sashimi Tokujo 1 - 21 Peças', 'Combinado com 07 fatias de sashimi de salmão, 05 fatias de sashimi atum, 01 dupla de atum, 01 dupla de salmão, 01 unid jo de salmão, 04 uramaki spicy tuna.', 143.00, 99, 'https://i.postimg.cc/1zYS1hj7/tokujo1.jpg', true, 0, 2],
            ['Sashimi de salmão - 5 fatias', 'Salmão fresco, fatiado.', 35.43, 99, 'https://i.postimg.cc/25sRy8jM/sashimi-salm-o.jpg', true, 0, 3],
            ['Salmão Selado com Gergelim', 'Fatias de salmão selada com gergelim.', 45.00, 99, 'https://i.postimg.cc/Wp7CL7ZQ/salm-o-grelhado-gergelim.jpg', true, 0, 3],
            ['Sashimi de Buri', 'Fatias de peixe buri', 37.00, 99, 'https://i.postimg.cc/fymBCmdj/sashimi-buri.png', true, 0, 3],
            ['Temaki de Salmão', 'Temaki de salmão batido e arroz.', 38.15, 99, 'https://i.postimg.cc/cLWcxqNh/temaki-salmao.png', true, 0, 4],
            ['Temaki de Spicy Tuna', 'Temaki de atum batido, com ovas e tabasco e arroz.', 42.90, 99, 'https://i.postimg.cc/3w4NzRbc/temaki-spicy-tuna.jpg', true, 0, 4],
            ['Temaki de Filadélfia', 'Temaki de salmão grelhado, arroz, cream cheese, e ovas de massago.', 34.10, 99, 'https://i.postimg.cc/YSbRDdZ3/temaki-filadelfia.png', true, 0, 4],
            ['Mochi Ice Cream', 'Sorvete de mochi recheado com sorvete.', 13.00, 99, 'https://i.postimg.cc/PrV87B5N/mochi.png', true, 0, 5],
            ['Harumaki', 'Rolinho primavera.', 18.00, 99, 'https://i.postimg.cc/8Pf113b7/harumaki.jpg', true, 0, 5],
            ['Parfait', 'camadas de sorvete, granolas, chantilly, cobertos com frutas frescas.', 20.00, 99, 'https://i.postimg.cc/LsQ94MGZ/parfait.png', true, 0, 5],
            ['Coca-cola', '(Latinha)', 8.50, 99, 'https://i.postimg.cc/Jz6VZ5xf/coca-cola.png', true, 0, 6],
            ['Fanta', '(Latinha)', 8.50, 99, 'https://i.postimg.cc/76TkxJgp/fanta.jpg', true, 0, 6],
            ['Guaraná', '(Latinha)', 8.50, 99, 'https://i.postimg.cc/GhdZf550/guarana.png', true, 0, 6],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product[0],
                'description' => $product[1],
                'price' => $product[2],
                'stock' => $product[3],
                'url_image' => $product[4],
                'is_active' => $product[5],
                'discount' => $product[6],
                'category_id' => $product[7]
            ]);
        }
    }
}
