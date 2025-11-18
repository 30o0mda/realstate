<?php
namespace App\Modules\GeneralData\Providers;
use Illuminate\Support\ServiceProvider;
class GeneralDataServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
public function boot(): void
{
    $modulePath = app_path('Modules/GeneralData');

    $routeFile = $modulePath . '/routes/api.php';
    if (file_exists($routeFile)) {
        $this->loadRoutesFrom($routeFile);
    }

    $migrationsPath = $modulePath . '/Database/migrations';
    if (is_dir($migrationsPath)) {
        $this->loadMigrationsFrom($migrationsPath);
    }

    foreach (glob($modulePath . '/Helpers/*.php') as $filename) {
        require_once $filename;
    }
}
}
