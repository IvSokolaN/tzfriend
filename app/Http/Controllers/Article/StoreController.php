<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article;
use App\Services\Article\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * @param StoreRequest $request
     * @param ArticleService $articleService
     * @return ArticleResource
     */
    public function __invoke(StoreRequest $request, ArticleService $articleService): ArticleResource
    {
        $articleService->store($request);
        $article = $articleService->getArticle();

        return ArticleResource::make($article);
    }
}
