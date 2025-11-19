<?php

namespace App\Http\Requests\Admin\Location;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'floor' => 'required|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Nama lokasi harus diisi',
            'name.max' => 'Nama lokasi maksimal 255 karakter',
            'location.required' => 'Gedung/area harus diisi',
            'location.max' => 'Gedung/area maksimal 255 karakter',
            'room.required' => 'Ruangan harus diisi',
            'room.max' => 'Ruangan maksimal 255 karakter',
            'floor.required' => 'Lantai harus diisi',
            'floor.max' => 'Lantai maksimal 255 karakter',
        ];
    }
}