<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed']
        ];
    }

    public function getInputData(): RegisterData
    {
        return new RegisterData(
            $this->input('name'),
            $this->input('email'),
            $this->input('password'),
            Hash::make($this->input('password')),
        );
    }

}
