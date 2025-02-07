<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\UpdateRequest;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article;
use App\Services\Article\ArticleService;

class UpdateController extends Controller
{
    /**
     * @param Article $article
     * @param UpdateRequest $request
     * @param ArticleService $articleService
     * @return ArticleResource
     */
    public function __invoke(Article $article, UpdateRequest $request, ArticleService $articleService): ArticleResource
    {
        $articleService->update($article, $request);
        $article = $articleService->getArticle();

        return ArticleResource::make($article);
    }
}
