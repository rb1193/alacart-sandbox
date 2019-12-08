<?php

namespace App\Shop\Product\Database;

use Astrotomic\Translatable\Translatable;
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
     * @internal will change to protected
     */
    public function getTranslationModelName(): string
    {
        return ProductTranslation::class;
    }
}
