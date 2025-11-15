<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var ?User */
        $user = $this->user();
        if ($user === null) {
            throw new \Illuminate\Auth\AuthenticationException('Authenticated user not found.');
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                // @phpstan-ignore property.notFound
                Rule::unique(User::class)->ignore($user->id),
            ],
        ];
    }
}
