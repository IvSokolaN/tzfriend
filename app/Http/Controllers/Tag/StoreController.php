<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreRequest;
use App\Http\Resources\Tag\SimpleTagResource;
use App\Models\Tag;

class StoreController extends Controller
{
    /**
     * @param StoreRequest $request
     * @return SimpleTagResource
     */
    public function __invoke(StoreRequest $request): SimpleTagResource
    {
        $tag = Tag::query()->create($request->validated());

        return SimpleTagResource::make($tag);
    }
}
