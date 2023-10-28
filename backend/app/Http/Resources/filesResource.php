<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            "url" =>  url("/storage/".$this->user_id."/".$this->fileName),
            "updated_at" => Carbon::parse($this->updated_at)->format('j F Y'),
            "type" => $this->type,
            "size" => $this->size,
            "stared" => $this->stared
        ];
    }
}
