<?php

namespace App\Http\Middleware;

use App\Shop\Product\Database\Product;
use Astrotomic\Translatable\Locales;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use InvalidArgumentException;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $selection = Config::get('app.locale_selection');

        switch ($selection) {
            case 'subdomain':
                $locale = Str::before($request->getHost(), '.');
                $this->setLocale($locale);
                break;
            
            default:
                throw new InvalidArgumentException(trans('locale.selection.invalid'));
                break;
        }

        return $next($request);
    }

    /**
     * Set the locale value for the request
     *
     * @param string $locale
     *
     * @return void
     */
    protected function setLocale(string $locale)
    {
        $locales = App::make(Locales::class);

        if (!in_array($locale, $locales->all())) {
            $locale = Config::get('translatable.fallback_locale');
        }

        App::setLocale($locale);

        $this->addGlobalScopeToModels($locale);
    }

    /**
     * Add the global locale scope to relevant models
     *
     * @param string $locale
     */
    protected function addGlobalScopeToModels(string $locale)
    {
        $scope = function (Builder $query) use ($locale) {
            $query->translatedIn($locale);
        };

        Product::addGlobalScope($scope);
    }
}
