<?php

namespace App\Shop\Product\Database;

use Astrotomic\Translatable\Locales;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Product extends Model
{
    use Translatable;

    /**
     * The attributes that should be mass-assignable
     *
     * @var array
     */
    protected $fillable = ['sku', 'name', 'description'];

    /**
     * The attributes that should be translatable
     *
     * @var array
     */
    public $translatedAttributes = ['description', 'name', 'slug'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        $prefix = Route::current()->getPrefix();

        return $prefix === 'api' ? 'sku' : 'slug';
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        return $this->whereTranslation('slug', $value, $this->getLocalesHelper()->current())->firstOrFail();
    }

    /**
     * @internal will change to protected
     */
    public function getTranslationModelName(): string
    {
        return ProductTranslation::class;
    }
}
