<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class SpecsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'vendor_id' => $this->vendor_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'data' => json_decode($this->data),
            'vendor' => new SpecsVendorResource($this->vendor),
        ];
    }
}
