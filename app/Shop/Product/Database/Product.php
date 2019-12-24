<?php

namespace App\Shop\Product\Database;

use Astrotomic\Translatable\Locales;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
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
     * Retrieve the model for a product slug value.
     *
     * @param mixed $value
     *
     * @return self
     */
    public static function resolveSlugRouteBinding($value): self
    {
        $locale = App::make(Locales::class)->current();
        return self::whereTranslation('slug', $value, $locale)->firstOrFail();
    }

    /**
     * Resolve the model binding
     *
     * @param mixed $value
     *
     * @return self
     */
    public static function resolveSkuRouteBinding($value): self
    {
        return self::where('sku', $value)->firstOrFail();
    }

    /**
     * @internal will change to protected
     */
    public function getTranslationModelName(): string
    {
        return ProductTranslation::class;
    }

    /**
     * Get a translation or fail
     *
     * @param string $locale
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     *
     * @return \App\Shop\Product\Database\ProductTranslation
     */
    public function translateOrFail(string $locale): ProductTranslation
    {
        $translation = $this->getTranslation($locale);

        if (is_null($translation)) {
            throw new ModelNotFoundException();
        }

        return $translation;
    }

    /**
     * Update an existing translation or create a new one
     *
     * @param string $locale
     * @param array $attributes
     *
     * @return \App\Shop\Product\Database\ProductTranslation
     */
    public function translateOrCreate(string $locale, array $attributes): ProductTranslation
    {
        $translation = $this->translateOrNew($locale);
        $translation->product_id = $this->id;
        $translation->fill($attributes)->save();

        return $translation;
    }
}
