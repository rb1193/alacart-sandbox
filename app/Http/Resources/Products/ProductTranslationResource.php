<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductTranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'description' => $this->description,
            'name' => $this->name,
            'locale' => $this->locale,
            'slug' => $this->slug,
        ];
    }
}
