<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RemoveFileResource extends JsonResource
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
            'id' => $this->id,
            'storageId' => $this->storageId,
            'path' => $this->path,
            'typeId' => $this->typeId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
