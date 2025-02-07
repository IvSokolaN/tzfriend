<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;

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
