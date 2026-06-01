<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'sku'               => $this->sku,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'type'              => $this->type,
            'condition'         => $this->condition,
            'description_title' => $this->description_title,
            'description_text'  => $this->description_text,
            'price_wo_vat'      => $this->price_wo_vat,
            'price'             => $this->price,
            'wholesale_price'   => $this->wholesale_price,
            'published'         => $this->published,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}