<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SettingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toResponse($request)
    {
        return [
            'status' => 'true',
            'setting' => $this->collection->map(function ($setting){
                return new SettingResource($setting);
            }),
            'count' => $this->collection->count(),
        ];
    }
}
