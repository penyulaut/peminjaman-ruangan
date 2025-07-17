<?php
namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validasi data yang dikirimkan oleh form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'nim' => 'required|string|max:20|unique:users', // Validasi nim
            'jurusan' => 'required|string|max:100', // Validasi jurusan
            'no_hp' => 'required|string|max:15', // Validasi no_hp
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:mahasiswa,dosen',
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $validatedData['name'],
            'nim' => $validatedData['nim'],
            'jurusan' => $validatedData['jurusan'],
            'no_hp' => $validatedData['no_hp'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        // Redirect ke halaman login setelah berhasil registrasi
        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login');
    }
}