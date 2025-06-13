<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('importer', function () {
            return new class
            {
                public function import(string $filePath): array
                {
                    return [
                        ['product_code' => 'P001', 'quantity' => 10],
                        ['product_code' => 'P002', 'quantity' => 5],
                        ['product_code' => 'P003', 'quantity' => 0], // will be skipped
                    ];
                }
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
