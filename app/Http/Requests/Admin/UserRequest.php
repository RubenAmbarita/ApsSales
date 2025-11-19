<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        // Tentukan aturan unik untuk NIP.
        // Saat update, abaikan NIP milik user yang sedang diedit.
        $userParam = $this->route('user');
        $userId = is_object($userParam) ? ($userParam->id ?? null) : $userParam;

        $nipUniqueRule = Rule::unique('users', 'nip');
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            if ($userId) {
                $nipUniqueRule = Rule::unique('users', 'nip')->ignore($userId);
            }
        }

        // Aturan unik untuk Email.
        $emailUniqueRule = Rule::unique('users', 'email');
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            if ($userId) {
                $emailUniqueRule = Rule::unique('users', 'email')->ignore($userId);
            }
        }

        return [
            'name' => 'required|string|max:50',
            'nip' => ['required', 'digits:18', $nipUniqueRule],
            'email' => ['required', 'email', $emailUniqueRule],
            'roles' => 'nullable|string|in:ADMIN,KATIMJA,STAFF',
            'id_department' => ['required', 'exists:tb_department,id']
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'nip.unique' => 'NIP sudah terdaftar.',
            'nip.digits' => 'NIP harus terdiri dari 18 digit.',
            'nip.required' => 'NIP wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
        ];
    }
}
