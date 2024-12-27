<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    // Tampilkan form registrasi
    public function showRegistrationForm()
    {
        $Role=Role:: all();
        return view('auth.register',["role"=>$Role]);
    }

    // Tangani proses registrasi
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru
        $pengguna=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password sebelum menyimpan
        ]);
        $Role=Role::find ([]);

        // Redirect ke halaman login atau halaman lain yang diinginkan
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil, silakan login.');
    }
}

