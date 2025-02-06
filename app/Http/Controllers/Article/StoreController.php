<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StoreController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $articles = Article::query()
            ->with('user')
            ->paginate(10);

        return ArticleResource::collection($articles);
    }
}
