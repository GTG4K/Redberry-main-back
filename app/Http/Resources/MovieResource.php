<?php

namespace App\Http\Resources;

use App\Models\Comment;
use App\Models\Quote;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->getTranslations('title'),
            'poster' => $this->poster,
            'slug' => $this->slug,
            'description' => $this->getTranslations('description'),
            'genre' => $this->genre,
            'release_date' => $this->release_date,
            'director' => $this->getTranslations('director'),
            'created_at' => $this->created_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'quotes' => QuoteResource::collection($this->whenLoaded('quotes')),
        ];
    }
}
