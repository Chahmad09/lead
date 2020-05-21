<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class catcollection extends JsonResource
{
    public $collects = 'App\Http\Resources\catresource';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         return [
            'data' => $this->collection,
        ];
    }
}
