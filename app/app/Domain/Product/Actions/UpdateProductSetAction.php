<?php

namespace App\Domain\Product\Actions;

use App\Domain\Product\Models\ProductSet;
use Illuminate\Support\Str;

class UpdateProductSetAction
{
    public function execute(ProductSet $set, array $data): ProductSet
    {
        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $set->update($data);

        return $set->refresh();
    }
}