<?php

namespace App\Domains\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user()->id),
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Imię jest wymagane.',
            'name.max' => 'Imię nie może przekraczać 255 znaków.',
            'email.required' => 'Adres e-mail jest wymagany.',
            'email.email' => 'Podaj prawidłowy adres e-mail.',
            'email.unique' => 'Ten adres e-mail jest już zajęty.',
        ];
    }
}
