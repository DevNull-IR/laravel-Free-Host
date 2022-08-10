<?php

namespace DevNullIr\LaravelFreeHost\core\Providers;

use DevNullIr\LaravelFreeHost\core\Facade\LaravelFreeHost;
use Illuminate\Support\ServiceProvider;

class LaravelFreeHostProvider extends ServiceProvider
{
    protected string $appConfig = __DIR__ . "/../config/config.php";

    public function register(): void
    {
        $this->mergeConfigFrom($this->appConfig, "laravel-free-host");

        $this->app->bind("LaravelFreeHost", function (){
            return new LaravelFreeHost();
        });
    }

    public function boot(): void
    {
        $this->_loadConfig();
        $this->loadRoutesFrom(__DIR__ . "/../routes/web.php");
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->publishes([
            __DIR__ . "/../database/migrations" => database_path("migrations")
        ],'laravel-free-host-migrations');
    }

    protected function _loadConfig(): void
    {
        $this->publishes([
            $this->appConfig => config_path("laravel-free-host.php")
        ],
        "laravel-free-host");
    }
}
