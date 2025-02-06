<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ShowController extends Controller
{
    /**
     * @param Article $article
     * @return ArticleResource
     */
    public function __invoke(Article $article): ArticleResource
    {
        return ArticleResource::make($article);
    }
}
