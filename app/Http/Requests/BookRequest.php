<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'cover_types' => 'required|array',
            'cover_types.*' => 'exists:cover_types,id',
            'genres' => 'required|array',
            'genres.*' => 'exists:genre,id',
            'file' => 'required|file|mimes:txt,doc,pdf,docx,rtf',
            'preview_img' => 'required|file|mimes:gif,jpeg,png,svg|max:2048',
        ];

        if ($this->isMethod('PATCH')) {
            $rules['file'] = str_replace('required', 'nullable', $rules['file']);
            $rules['preview_img'] = str_replace('required', 'nullable', $rules['preview_img']);
        }

        return $rules;
    }

    /**
     * Get error messages for specific validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле имени является обязательным.',
            'name.string' => 'Поле имени должно быть строкой.',
            'name.max' => 'Имя не должно превышать 100 символов.',

            'description.required' => 'Поле краткого описания является обязательным.',
            'description.string' => 'Поле краткого описания должно быть строкой.',

            'authors.required' => 'Поле автора является обязательным.',

            'cover_types.required' => 'Поле обложки является обязательным.',

            'genres.required' => 'Поле жанра является обязательным.',

            'file.required' => 'Поле книги является обязательным.',
            'file.image' => 'Поле книги должно быть файлом.',
            'file.mimes' => 'Поле книги должно иметь расширение: txt, doc, pdf, docx, rtf.',

            'preview_img.required' => 'Поле обложки книги является обязательным.',
            'preview_img.image' => 'Поле обложки книги должно быть изображением.',
            'preview_img.mimes' => 'Поле обложки книги должно иметь расширение: gif, jpeg, png, svg.',
            'preview_img.max' => 'Поле обложки книги изображение не должно превышать: 2 мегабайта.',
        ];
    }
}
