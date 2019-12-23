<?php

namespace App\Shop\Product\Database;

use Astrotomic\Translatable\Locales;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Translatable;

    /**
     * The attributes that should be translatable
     *
     * @var array
     */
    public $translatedAttributes = ['description', 'name', 'slug'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(function (Builder $query) {
            $query->translatedIn(app(Locales::class)->current());
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
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
