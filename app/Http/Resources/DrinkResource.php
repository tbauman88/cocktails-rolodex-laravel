<?php

namespace App\Http\Resources;

use App\Models\Ingredient;
use Illuminate\Http\Resources\Json\JsonResource;

class DrinkResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
            'notes' => $this->notes,
            'published' => $this->published,
            'saveCount' => $this->save_count,
            'serves' => $this->serves,
            'directions' => $this->directions,
            'user' => $this->user->name,
            'ingredients' => $this->ingredients->map(fn(Ingredient $ingredient) => [
                'name' => $ingredient->name,
                'amount' => $ingredient->pivot->amount,
                'amount_unit' => $ingredient->pivot->amount_unit,
                'garnish' => $ingredient->pivot->garnish,
                'brand' => $ingredient->pivot->brand,
                'required' => $ingredient->pivot->required,
            ]),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
