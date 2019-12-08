<?php

namespace App\Shop\Product\Database;

use Astrotomic\Translatable\Translatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Sluggable, Translatable;

    /**
     * The attributes that should be translatable
     *
     * @var array
     */
    public $translatedAttributes = ['description', 'name', 'slug'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
