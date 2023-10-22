<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Tymon\JWTAuth\Facades\JWTAuth;

class filesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "fileName"=> $this->fileName,
            "url" => $this->type == "image" ? url("/storage/".$this->user_id."/".$this->fileName) : null,
            "updated_At" => $this->updated_at,
            "type" => $this->type,
            "stared" => $this->stared
        ];
    }
}
