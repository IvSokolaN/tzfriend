<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Resources\Tag\TagResource;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ShowController extends Controller
{
    /**
     * @param Tag $tag
     * @return TagResource
     */
    public function __invoke(Tag $tag): TagResource
    {
        return TagResource::make($tag);
    }
}
