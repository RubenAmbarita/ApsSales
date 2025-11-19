<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SopRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'no_sop' => ['required','string','max:100'],
            'name' => ['required','string','max:255'],
            'version' => ['required','string','max:100'],
            'retention_period' => ['required','string','max:100'],
            'id_department' => ['required','integer','exists:tb_department,id'],
            'effective_date' => ['required','date'],
            'approved_by' => ['required','string','max:255'],
            'file' => ['nullable','file','mimes:pdf,doc,docx,png,jpg,jpeg','max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'no_sop.required' => 'Nomor SOP wajib diisi.',
            'name.required' => 'Nama SOP wajib diisi.',
            'version.required' => 'Versi SOP wajib diisi.',
            'retention_period.required' => 'Masa retensi wajib diisi.',
            'id_department.required' => 'Departemen wajib dipilih.',
            'id_department.exists' => 'Departemen tidak valid.',
            'effective_date.required' => 'Tanggal berlaku wajib diisi.',
            'approved_by.required' => 'Penyetuju wajib diisi.',
            'file.mimes' => 'File harus berupa PDF/DOC/IMG.',
        ];
    }
}