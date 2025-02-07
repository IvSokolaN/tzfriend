<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class DestroyController extends Controller
{
    /**
     * @param Tag $tag
     * @return JsonResponse
     */
    public function __invoke(Tag $tag): JsonResponse
    {
        $tag->delete();

        return response()->json([
            'success' => true,
            'message' => 'Тег успешно удален.',
        ]);
    }
}
