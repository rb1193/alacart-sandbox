<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your REST api controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $restNamespace = 'App\Http\Api';

    /**
     * This namespace is applied to your shopfront controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $shopfrontNamespace = 'App\Http\Shopfront';


    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind('locale', function ($value) {
            if (!in_array($value, Config::get('translatable.locales'))) {
                throw new NotFoundHttpException();
            }

            return $value;
        });
        Route::bind('product', function ($value) {
            return \App\Shop\Product\Database\Product::resolveSlugRouteBinding($value);
        });
        Route::bind('product_sku', function ($value) {
            return \App\Shop\Product\Database\Product::resolveSkuRouteBinding($value);
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapShopfrontRoutes();
    }

    /**
     * Define the "shopfront" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapShopfrontRoutes()
    {
        Route::middleware('web')
             ->namespace($this->shopfrontNamespace)
             ->group(base_path('routes/shopfront.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->restNamespace)
             ->group(base_path('routes/api.php'));
    }
}
