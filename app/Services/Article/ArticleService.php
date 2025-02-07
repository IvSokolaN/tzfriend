<?php

namespace App\Services\Article;

use App\Http\Requests\Article\StoreRequest;
use App\Models\Article;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ArticleService
{
    private Article $article;


    /**
     * @param StoreRequest $request
     * @return void
     */
    public function store(StoreRequest $request): void
    {
        $userId = auth()->user()->id;

        $pathImage = $this->uploadImage($request->file('preview_image'));

        $this->article = Article::query()
            ->create([
                'title' => $request->string('title'),
                'content' => $request->string('content'),
                'published_at' => $request->date('published_at'),
                'preview_image' => $pathImage,
                'user_id' => $userId,
            ]);

        $this->article->tags()->sync($request->array('tags'));
    }

    public function update(Article $article, StoreRequest $request): Article
    {
        $pathImage = $this->uploadImage($request->file('preview_image'));

        $article->update([
            'title' => $request->string('title'),
            'content' => $request->string('content'),
            'published_at' => $request->date('published_at'),
            'preview_image' => $pathImage,
        ]);

        $article->tags()->sync($request->array('tags'));

        return $article;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    /**
     * @param UploadedFile|null $file
     * @return string|null
     */
    private function uploadImage(?UploadedFile $file): ?string
    {
        $pathImage = null;

        if ($file) {
            $pathImage = Storage::disk('public')->putFile('images/articles', $file);
        }

        return $pathImage;
    }
}
