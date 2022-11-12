<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MotosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
                'id'=> $this->id,
                'numero_Atv'=> $this->numero_Atv,
                'max_velocidad'=> $this->max_velocidad ,
                'placa'=> $this->placa,
                'num_serie'=> $this->num_serie ,
                'num_motor'=> $this->num_motor ,
                'propietario'=> $this->propietario ,
                'marca'=> $this->marca,
                'modelo'=> $this->modelo ,
                'color'=> $this->color ,
                'activa'=> $this->activa,
                'egresos' => EgresoResource::collection($this->whenLoaded('egresos'))

        ];
    }
}
