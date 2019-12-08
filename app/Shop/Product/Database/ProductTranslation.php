<?php

namespace App\Shop\Product\Database;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use Sluggable;

    /**
     * Disable timestamps for translations
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The fillable attributes on this model
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

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
