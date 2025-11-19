<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'no_rack' => ['required','string','max:255'],
            'rack_unit' => ['required','string','max:255'],
            'brand' => ['required','string','max:255'],
            'model' => ['required','string','max:255'],
            'serial_number' => ['required','string','max:255'],
            'application' => ['required','string','max:255'],
            'status' => ['required','string','in:Aktif,Perbaikan,Tidak Aktif'],
            'procurement_date' => ['required','date'],
            'acquition_date' => ['required','date'],
            'description' => ['nullable','string'],
        ];
    }

    public function messages(): array
    {
        return [
            'no_rack.required' => 'No rack wajib diisi.',
            'rack_unit.required' => 'Rack unit wajib diisi.',
            'brand.required' => 'Brand wajib diisi.',
            'model.required' => 'Model wajib diisi.',
            'serial_number.required' => 'Serial number wajib diisi.',
            'application.required' => 'Aplikasi wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status harus salah satu dari: Aktif, Perbaikan, atau Tidak Aktif.',
            'procurement_date.required' => 'Tanggal pengadaan wajib diisi.',
            'acquition_date.required' => 'Tanggal perolehan wajib diisi.',
        ];
    }
}