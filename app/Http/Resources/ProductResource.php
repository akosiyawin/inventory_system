<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'code' => $this->id,
            'title' => $this->title,
            'category' => $this->category->title,
            'category_id' => $this->category->id,
            'stock' => $this->stock,
            'manufactured_date' => $this->manufactured_date,
            'expiration_date' => $this->expiration_date,
        ];
    }
}
