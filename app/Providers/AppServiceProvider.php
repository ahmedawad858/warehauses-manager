<?php

namespace App\Providers;

use App\Models\Item;
use App\Models\User;
use Database\Seeders\ItemSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WarehouseSeeder;
use Illuminate\Support\ServiceProvider;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Warehouse::count() === 0) {
            $seeder = new WarehouseSeeder();
            $seeder->run();
        }

        if (Item::count() === 0) {
            $seeder = new ItemSeeder();
            $seeder->run();
        }
        if (User::count() === 0) {
            $seeder = new UserSeeder();
            $seeder->run();
        }
    }
}
