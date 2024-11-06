<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlavorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {

        return [

            'id'        =>  $this->id,
            'name'      =>  $this->name,
            'slug'      =>  $this->slug,
            'image'     =>  asset($this->image),
            'price'     =>  number_format($this->price) . ' KM',
            'rank'      =>  $this->rank,
            'brand'     =>  BrandResource::make($this->brand),

        ];

    }
}
