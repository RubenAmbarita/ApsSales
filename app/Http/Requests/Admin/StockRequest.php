<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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
            'id_tower' => 'required|integer|exists:towers,id',
            'status' => 'nullable|string|in:SOLD,READY,ONPROCESS',
            'price' => 'required|integer',
            'unit' => 'required|string'
        ];
    }
}
