<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Product;
use App\Models\Category;
use App\Models\Settings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        return true;
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view)
        {
            // $general = Settings::findOrFail(1);
            // $view->with(['general' =>  $general]);
        });
    }
}
