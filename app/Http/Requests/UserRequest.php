<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
            'address' => 'required|string|max:255',
            'city_id' => 'required|integer|exists:cities,id',
            'phone' => 'required|string|max:13',
            'library_card' => 'required|string|max:10',
            'email' => 'required|string|max:80|unique:users|email',
            'password' => 'required|confirmed|string|min:6'
        ];

        if ($this->isMethod('PATCH')) {
            unset($rules['email']);
            unset($rules['password']);
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

            'address.required' => 'Поле адрес является обязательным.',
            'address.string' => 'Поле адрес должно быть строкой.',
            'address.max' => 'адрес не должен превышать 255 символов.',

            'city_id.required' => 'Поле город является обязательным.',
            'city_id.integer' => 'Поле город является обязательным.',
            'city_id.exists' => 'Выбранный идентификатор города недействителен.',

            'phone.required' => 'Поле номера телефона является обязательным.',
            'phone.max' => 'Номер телефона не должен превышать 13 символов.',

            'library_card.required' => 'Поле код паспорта является обязательным.',
            'library_card.max' => 'Код паспорта не должен превышать 10 символов.',

            'email.required' => 'Поле Email является обязательным.',
            'email.string' => 'Поле Email должно быть строкой.',
            'email.max' => 'Поле Email не должен превышать 80 символов.',
            'email.unique' => 'Поле Email должно быть уникальным.',

            'password.required' => 'Поле пароля является обязательным.',
            'password.confirmed' => 'Проверяемое поле должно совпадать.',
            'password.string' => 'Поле пароля должно быть строкой.',
            'password.min' => 'Поле пароля должно иметь не менее 6 символов.',
        ];
    }
}
