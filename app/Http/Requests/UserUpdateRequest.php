<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'max:255'],
            'name' => ['required', 'max:255', 'string'],
            'foto' => ['image', 'max:1024', 'nullable'],
            'nim' => ['nullable', 'max:255', 'string'],
            'Prodi' => ['nullable', 'max:255', 'string'],
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($this->user),
                'email',
            ],
            'tanggal' => ['nullable', 'date'],
            'password' => ['nullable'],
        ];
    }
}
