<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
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
        Paginator::useTailwind();

        URL::forceRootUrl(config('app.url'));

        if (str_starts_with(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

        // View composer global para a quantidade do carrinho
        View::composer('*', function ($view) {
            $quantidade = 0;

            if (Auth::check()) {

                $quantidade = session('carrinho_quantidade', 0);

      
            }

            $view->with('carrinho_quantidade', $quantidade);
        });
    }
}
