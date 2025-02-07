<?php

namespace App\Services\Article;

use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Models\Article;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ArticleService
{
    private Article $article;
    private ?string $pathImage = null;


    /**
     * @param StoreRequest $request
     * @return void
     */
    public function store(StoreRequest $request): void
    {
        $userId = auth()->user()->id;
        $this->uploadImage($request->file('preview_image'));

        $this->article = Article::query()
            ->create([
                'title' => $request->string('title'),
                'content' => $request->string('content'),
                'published_at' => $request->date('published_at'),
                'preview_image' => $this->pathImage,
                'user_id' => $userId,
            ]);

        $this->article->tags()->sync($request->array('tags'));
    }

    /**
     * @param Article $article
     * @param UpdateRequest $request
     * @return void
     */
    public function update(Article $article, UpdateRequest $request): void
    {
        $this->pathImage = $article->preview_image;
        $this->updateImage($article, $request->file('preview_image'));

        $article->update([
            'title' => $request->input('title') ?? $article->title,
            'content' => $request->input('content') ?? $article->content,
            'published_at' => $request->input('published_at') ?? $article->published_at,
            'preview_image' => $this->pathImage,
        ]);

        $article->tags()->sync($request->array('tags'));

        $this->article = $article;
    }

    /**
     * @return Article
     */
    public function getArticle(): Article
    {
        return $this->article;
    }

    /**
     * @param UploadedFile|null $file
     * @return void
     */
    private function uploadImage(?UploadedFile $file): void
    {
        if ($file) {
            $this->pathImage = Storage::disk('public')->putFile('images/articles', $file);
        }
    }

    /**
     * @param Article $article
     * @param UploadedFile|null $file
     * @return void
     */
    private function updateImage(Article $article, ?UploadedFile $file): void
    {
        if ($file) {
            $article->deletePreviewImage();
            $this->uploadImage($file);
        }
    }
}
