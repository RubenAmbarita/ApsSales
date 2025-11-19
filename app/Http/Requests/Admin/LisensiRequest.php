<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LisensiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_vendor' => ['nullable','integer','exists:tb_vendor,id'],
            'software_name' => ['required','string','max:255'],
            'function' => ['required','string','max:255'],
            'license_key' => ['required','string','max:255'],
            'seats' => ['required','string','max:50'],
            'start_date' => ['required','date'],
            'expiry_date' => ['required','date','after_or_equal:start_date'],
            'assigned_to' => ['nullable','string','max:255'],
            'status' => ['required','string','max:50'],
            'file' => ['nullable','file','mimes:pdf,doc,docx,png,jpg,jpeg','max:5120'],
            'description' => ['nullable','string'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_vendor.exists' => 'Vendor tidak valid.',
            'software_name.required' => 'Nama software wajib diisi.',
            'function.required' => 'Fungsi software wajib diisi.',
            'license_key.required' => 'License key wajib diisi.',
            'seats.required' => 'Jumlah seat wajib diisi.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'expiry_date.required' => 'Tanggal berakhir wajib diisi.',
            'expiry_date.after_or_equal' => 'Tanggal berakhir harus sama atau setelah tanggal mulai.',
            'status.required' => 'Status wajib diisi.',
            'file.mimes' => 'File harus berupa PDF/DOC/IMG.',
        ];
    }
}