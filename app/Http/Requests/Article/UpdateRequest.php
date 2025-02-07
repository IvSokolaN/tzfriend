<?php

namespace App\Http\Requests\Article;

use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'content' => [
                'nullable',
                'string',
                'max:65535',
            ],
            'preview_image' => [
                'nullable',
                'image',
            ],
            'tags' => [
                'nullable',
                'array',
            ],
            'tags.*' => [
                'required',
                'numeric',
                'exists:tags,id',
            ],
            'published_at' => [
                'nullable',
                'date',
            ],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'title.max' => 'Заголовок не должен превышать 255 символов',
            'title.string' => 'Заголовок должен быть строкой',
            'content.max' => 'Текст не должен превышать 65535 символов',
            'content.string' => 'Текст должен быть строкой',
            'preview_image.image' => 'Файл должен быть изображением',
            'published_at.date' => 'Дата должна быть датой',
            'tags.*.exists' => 'Тег не существует',
            'tags.array' => 'Тэги должны быть массивом',
            'tags.required' => 'Тэги обязательны для заполнения',
        ];
    }
}
