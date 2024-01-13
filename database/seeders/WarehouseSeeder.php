<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warehouses = [
            'قسم المواد الطبية والكيميائية',
            'قسم الأدوات المكتبية',
            'قسم الأدوات الإلكترونية',
            'قسم الأدوات الكهربائية',
            'قسم أدوات السباكة'
        ];

        foreach ($warehouses as $name) {
            Warehouse::create([
                'name' => $name,
                'location' => 'كلية دار العلوم والتكنولوجيا' // Replace with actual location if available
            ]);
        }
    }
}
