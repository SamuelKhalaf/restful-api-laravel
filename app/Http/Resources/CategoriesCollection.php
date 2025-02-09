<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoriesCollection extends ResourceCollection
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
            'categories' => $this->collection->map(function ($category){
                return new CategoriesResource($category);
            }),
            'count' => $this->collection->count(),
        ];
    }
}
