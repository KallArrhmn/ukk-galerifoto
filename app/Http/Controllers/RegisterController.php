<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.register');
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:225'],
            'nis' => ['required', 'integer', 'min:9', 'unique:users,nis'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:3']
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if ($user) {
            Alert::success('Berhasil Register!', 'Silakan Login');
            return redirect()->route('login.index');
        } else {
            Alert::error('Register gagal silahkan coba lagi');
            return redirect()->back();
        }
    }
}
