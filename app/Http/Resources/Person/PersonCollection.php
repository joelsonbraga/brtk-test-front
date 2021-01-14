<?php

namespace App\Http\Resources\Person;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $collection = $this->resource->toArray();
        $collection['data'] = $this->collection->map(function ($item, $key) {
            return [
                'uuid' => $item->uuid,
                'person_id' => $item->person_id,
                'cpf'       => $item->cpf,
                'name'      => $item->name,
                'email'     => $item->email,
                'phone' => $item->phone,
            ];
        })->toArray();

        return $collection;
    }
}
