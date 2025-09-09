<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna memiliki izin untuk melakukan permintaan ini.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // Jika Anda ingin memverifikasi hak akses, ubah menjadi false dan tentukan logika otorisasi
    }

    /**
     * Tentukan aturan validasi untuk permintaan ini.
     *
     * @return array
     */
    public function rules(): array
{
    return [
        'Nama_barang' => 'required|string|max:255',
        'kategoriID' => 'required|exists:kategori,KategoriID', // Pastikan kategoriID ada di tabel kategori
        'Harga_jual' => 'required|numeric|min:0',
        'Harga_dasar' => 'required|numeric|min:0',
        'Stok' => 'required|integer|min:0', // Stok harus angka dan tidak boleh negatif
    ];
}

public function messages(): array
{
    return [
        'kategoriID.required' => 'Kategori barang harus dipilih.',
        'kategoriID.exists' => 'Kategori yang dipilih tidak valid.',
        'Stok.required' => 'Stok barang harus diisi.',
        'Stok.integer' => 'Stok harus berupa angka.',
        'Stok.min' => 'Stok tidak boleh kurang dari 0.',
    ];
}
}
