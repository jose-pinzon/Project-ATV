<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EgresoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            "id"=> $this->id,
            "tipo_gasto"=> $this->tipo_gasto ,
            "gasto"=> $this->gasto ,
            "cantidad"=> $this->cantidad,
            "moto" => new MotosResource($this->moto)
        ];
    }
}
