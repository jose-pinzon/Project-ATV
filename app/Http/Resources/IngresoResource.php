<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IngresoResource extends JsonResource
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
            "id_ingreso"=> $this->id_ingreso,
            "fecha_hora"=> $this->fecha_hora ,
            "cantidad"=> $this->cantidad ,
            "total"=> $this->total
        ];
    }
}
