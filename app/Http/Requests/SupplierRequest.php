<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Nama' => 'required|string|max:255',
            'Alamat' => 'required|string|max:255',
            'Kontak' => 'required|string|max:50',
        ];
    }
}
