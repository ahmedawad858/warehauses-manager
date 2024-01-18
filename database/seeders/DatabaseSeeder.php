<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        if (User::count() === 0) {
            $this->call(UserSeeder::class);

        }
        if (Warehouse::count() === 0) {
            $this->call(WarehouseSeeder::class);

        }

        if (Item::count() === 0) {
            $this->call(ItemSeeder::class);

        }
        if (Transaction::count() === 0) {
            $this->call(TransactionSeeder::class);

        }

    }
}
