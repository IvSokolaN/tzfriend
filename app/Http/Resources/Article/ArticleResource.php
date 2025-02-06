<?php

namespace App\Http\Resources\Article;

use App\Http\Resources\Tag\SimpleTagResource;
use App\Http\Resources\User\SimpleUserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'preview_image' => asset($this->preview_image),
            'published_at' => $this->published_at,
            'tags' => SimpleTagResource::collection($this->tags),
            'user_id' => SimpleUserResource::make($this->user),
        ];
    }
}
