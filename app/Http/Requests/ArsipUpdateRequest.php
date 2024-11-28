<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArsipUpdateRequest extends FormRequest
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
            'nomor_surat' => ['nullable', 'max:255', 'string'],
            'judul' => ['required', 'max:255', 'string'],
            'kategorisurat_id' => ['required', 'exists:kategorisurats,id'],
            'flie_path' => ['file', 'max:1024', 'nullable'],
            'waktu_pengarsipan' => ['required', 'date'],
        ];
    }
}
