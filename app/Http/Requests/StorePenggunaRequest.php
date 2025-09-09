<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePenggunaRequest extends FormRequest
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
            'name'=> 'required|string|max:255',
            'email'=> 'required|email',
            'password'=> 'required|min:6|',
            'phone_number'=> 'required|string|max:255',
            'jenis_pengguna'=> rule::in(['admin', 'kasir', 'pembeli']),
            'referal_code'=> 'string:max:5'
        ];
    }
}
