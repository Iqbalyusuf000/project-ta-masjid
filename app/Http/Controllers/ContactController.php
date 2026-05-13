<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
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
                abort(422, 'Validasi error!');
            }

            Contact::create($validator->validated());

            return redirect()->route('contact.index')->with('success', 'Pesan berhasil dikirim.');
        } catch (\Throwable $th) {
            return redirect()->route('contact.index')->with('error', 'Pesan gagal dikirim.');
        }
    }

    public function index()
    {
        try {
            $info = Info::first();
            if (!$info) {
                abort(400, 'Informasi kontak tidak ditemukan.');
            }
            return view('pages.contact', compact('info'));
        } catch (\Throwable $th) {
            abort(500, 'Server error');
        }
    }
}
