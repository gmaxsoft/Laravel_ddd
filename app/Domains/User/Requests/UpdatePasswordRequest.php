<?php

namespace App\Domains\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
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
            'current_password' => ['required', 'string', function (string $attribute, mixed $value, \Closure $fail): void {
                if (! Hash::check($value, $this->user()->password)) {
                    $fail('Aktualne hasło jest nieprawidłowe.');
                }
            }],
            'password' => ['required', 'string', 'confirmed', Password::defaults()],
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
            'current_password.required' => 'Aktualne hasło jest wymagane.',
            'password.required' => 'Nowe hasło jest wymagane.',
            'password.confirmed' => 'Potwierdzenie hasła nie pasuje.',
        ];
    }
}
