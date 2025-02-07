<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\JsonResponse;

class DestroyController extends Controller
{
    /**
     * @param Article $article
     * @return JsonResponse
     */
    public function __invoke(Article $article): JsonResponse
    {
        $article->deletePreviewImage();
        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Статья успешно удалена.',
        ]);
    }
}
