<?php

namespace App\Providers;

use App\Contracts\Cart;
use App\Enums\AppType;
use App\Services\CartService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->singleton(Cart::class, fn () => new CartService());

        Blade::if('access', static fn (AppType $appType) => config('site.type') === $appType->value);

        Blade::directive('size', static function ($expression) {
            return "<?php echo match(true) {
                (int)$expression >= 1000000 => number_format(round((int)$expression / 1000000, 2), 2, ',', '') . 'Mo',
                (int)$expression >= 1000 => round((int)$expression / 1000) . 'Ko',
                default => $expression . 'o',
            }; ?>";
        });
    }
}
