<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
{
    public static bool $includeDrinks;

    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        if (self::$includeDrinks) {
            $data = array_merge($data, ["drinks" => $this->resource->drinks->map(fn($drink) => $drink->name)]);
        }

        return $data;
    }
}
