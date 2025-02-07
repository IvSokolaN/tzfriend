<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\UpdateRequest;
use App\Http\Resources\Tag\SimpleTagResource;
use App\Models\Tag;

class UpdateController extends Controller
{
    /**
     * @param Tag $tag
     * @param UpdateRequest $request
     * @return SimpleTagResource
     */
    public function __invoke(Tag $tag, UpdateRequest $request): SimpleTagResource
    {
        $tag->update($request->validated());

        return SimpleTagResource::make($tag);
    }
}
