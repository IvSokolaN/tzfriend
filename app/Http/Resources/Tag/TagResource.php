<?php

namespace App\Http\Resources\Tag;

use App\Http\Resources\Article\SimpleArticleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'articles' => SimpleArticleResource::collection($this->articles),
        ];
    }
}
