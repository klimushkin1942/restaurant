<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DishResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'category_id'  => $this->category_id,
            'name_dish' => $this->name_dish,
            'composition' => $this->composition,
            'price' => $this->price,
            'calories' => $this->calories,
            'img_src' => $this->img_src,
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
