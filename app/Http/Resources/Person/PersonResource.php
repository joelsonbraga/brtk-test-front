<?php

namespace App\Http\Resources\Person;

use App\Http\Resources\ContractService\ContractServiceResource;
use App\Http\Resources\State\StateResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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
            'id'    => $this->id,
            'uuid'  => $this->uuid,
            'cpf'   => $this->cpf,
            'name'  => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }
}
