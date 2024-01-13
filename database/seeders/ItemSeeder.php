<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetch all warehouses
        $warehouses = Warehouse::all();

        foreach ($warehouses as $warehouse) {
            // Generate 2-3 items for each warehouse
            for ($i = 0; $i < rand(2, 3); $i++) {
                Item::create([
                    'name' => 'Item ' . ($i + 1) . ' for ' . $warehouse->name,
                    'description' => 'Description for item ' . ($i + 1),
                    'quantity' => rand(10, 100), // Random quantity for example
                    // Add other necessary fields as required
                ]);
            }
        }
    }
}
