<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Pagination\Paginator;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        Paginator::useBootstrapFive();
        // Cart::updated(function ($cart) {
        //     if ($cart->qty > $cart->barang->stok) {
        //         $cart->qty = $cart->barang->stok;
        //         $cart->save();
        //     }
        // });
    }
}
