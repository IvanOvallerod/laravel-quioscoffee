<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'imagen' => $this->imagen,
            'nombre' => $this->nombre,
            'precio' => floatval($this->precio),
            'categoria_id' => intval($this->categoria_id),
        ];
    }
}
