<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'same:password_confirmation',
                Password::min(8)->letters()->numbers(),
            ],

            'password_confirmation' => [
                'required',
                'string',
            ],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Masukkan alamat email dengan format yang benar.',
            'email.unique' => 'Email sudah terdaftar. Gunakan email lain.',
            'password.required' => 'Password wajib diisi.',
            'password.same' => 'Konfirmasi password tidak sesuai.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil.',
        ], 201);
    }
}
