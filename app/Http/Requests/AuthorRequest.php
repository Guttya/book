<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AuthorRequest extends FormRequest
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
            'name' => 'required|max:100|string',
            'surname' => 'required|string|max:100',
            'description' => 'required|string',
            'avatar' => 'required|image|mimes:gif,jpeg,png,svg|max:2048'
        ];

        if ($this->isMethod('PATCH')) {
            $rules['avatar'] = str_replace('required', 'nullable', $rules['avatar']);
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

            'surname.required' => 'Поле фамилии является обязательным.',
            'surname.string' => 'Поле фамилия должно быть строкой.',
            'surname.max' => 'Фамилия не должна превышать 100 символов.',

            'description.required' => 'Поле краткого описания является обязательным.',
            'description.string' => 'Поле краткого описания должно быть строкой.',

            'avatar.required' => 'Поле фото автора является обязательным.',
            'avatar.image' => 'Поле фото автора должно быть изображением.',
            'avatar.mimes' => 'Поле фото автора должно иметь расширение: gif, jpeg, png, svg.',
            'avatar.max' => 'Поле фото автора изображение не должно превышать: 2 мегабайта.',
        ];
    }
}
