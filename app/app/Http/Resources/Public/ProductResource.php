<?php

namespace App\Http\Resources\Public;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type,
            'condition' => $this->condition,
            'description_title' => $this->description_title,
            'description_text' => $this->description_text,
            'price' => $this->price,
            'published' => $this->published,
        ];
    }
}