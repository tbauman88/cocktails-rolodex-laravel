<?php

namespace App\Http\Resources;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserIngredientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $ingredient = Ingredient::find($this->resource->ingredient_id);

        return [
            "id" => $this->resource->id,
            "name" => $ingredient->name,
            "brand" => $this->resource->brand,
            "category" => $this->resource->category,
            "created_at" => $this->resource->created_at,
            "updated_at" => $this->resource->updated_at,
        ];
    }

}
