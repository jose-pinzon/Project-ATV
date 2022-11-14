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
            "id_ingreso"=> $this->id,
            "fecha_hora"=> $this->tipo_gasto ,
            "cantidad"=> $this->gasto ,
            "total"=> $this->cantidad
        ];
    }
}
