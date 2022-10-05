<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\MenuComposer;
use App\Http\View\Composers\CartComposer;
use App\Http\View\Composers\AuthComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {   
        // Register Menu Composer
        View::composer(
            ['client.components.header',], 
            MenuComposer::class
        );

        // Register Cart Composer
        View::composer(
            [   
                'client.carts.headerCartContent',
                'client.carts.checkout',
                'client.carts.yourCart',
                'client.components.header',
            ], 
            CartComposer::class
        );
    }
}
