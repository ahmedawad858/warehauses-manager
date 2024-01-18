<?php

namespace App\Providers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\User;
use Database\Seeders\ItemSeeder;
use Database\Seeders\TransactionSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WarehouseSeeder;
use Illuminate\Routing\UrlGenerator;
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
    public function boot(UrlGenerator $url)
    {

        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
        }
        if (User::count() === 0) {
            $seeder = new UserSeeder();
            $seeder->run();
        }
        if (Warehouse::count() === 0) {
            $seeder = new WarehouseSeeder();
            $seeder->run();
        }

        if (Item::count() === 0) {
            $seeder = new ItemSeeder();
            $seeder->run();
        }
        if (Transaction::count() === 0) {
            $seeder = new TransactionSeeder();
            $seeder->run();
        }

    }
}
