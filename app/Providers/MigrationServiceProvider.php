<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }
   /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->hasPendingMigrations()) {
            Artisan::call('migrate', ['--force' => true]);
        }
    }


    private function hasPendingMigrations(): bool
    {
        // Check if the 'users' table exists
        $migrationsPath = database_path('migrations');
        $allMigrations = collect(File::files($migrationsPath))->map(function ($file) {
            return pathinfo($file, PATHINFO_FILENAME);
        });

        $dbMigrations = DB::table('migrations')->pluck('migration');

        $pendingMigrations = $allMigrations->diff($dbMigrations);

        return !$pendingMigrations->isEmpty();    }

}
