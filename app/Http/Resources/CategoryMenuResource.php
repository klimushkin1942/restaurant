<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryMenuResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_name' => $this->category_name,
            'img_src' => $this->img_src,
            'created_at' => $this->created_at->format('m/d/Y'),
            'updated_at' => $this->updated_at->format('m/d/Y'),
        ];
    }
}
