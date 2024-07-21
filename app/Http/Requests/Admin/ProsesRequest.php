<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProsesRequest extends FormRequest
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
            'id_tower' => 'integer|exists:towers,id',
            'id_sales' => 'integer|exists:users,id',
            'status' => 'nullable|string|in:ONPROCESS,SOLD',
            'price' => 'integer',
            'unit' => 'string'
        ];
    }
}
