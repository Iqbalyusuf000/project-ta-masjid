<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Info;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;

class ContactController extends ApiController
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|numeric|max_digits:13',
                'subject' => 'required|string|max:255',
                'description' => 'required|string',
            ], [
                'name.required' => 'Nama wajib diisi.',
                'name.max' => 'Nama maksimal 255 karakter.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'phone_number.required' => 'Nomor telepon wajib diisi.',
                'phone_number.numeric' => 'Nomor telepon hanya boleh berisi angka.',
                'phone_number.max_digits' => 'Nomor telepon maksimal 13 digit.',
                'subject.required' => 'Subjek wajib diisi.',
                'description.required' => 'Deskripsi wajib diisi.',
            ]);

            if ($validator->fails()) {
                return $this->responseValidationError('Data tidak valid.', $validator->errors());
            }

            $contact = Contact::create($validator->validated());

            return $this->responseCreated('Pesan berhasil dikirim.', $contact);
        } catch (\Throwable $th) {
            return $this->responseServerError('Pesan gagal dikirim.', $th->getMessage());
        }
    }

    public function index()
    {
        try {
            $info = Info::first();
            if (!$info) {
                return $this->responseNotFound('Informasi kontak tidak ditemukan.', []);
            }
            return $this->responseSuccess('Data berhasil diambil.', $info);
        } catch (\Throwable $th) {
            return $this->responseServerError('Data gagal diambil.', $th->getMessage());
        }
    }
}
