<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => strtoupper($this->name),
            'slug' => $this->slug,
            'description' => $this->description,
            'about' => "$this->name $this->description",
            'published_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
