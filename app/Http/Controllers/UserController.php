<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function daftar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namaLengkap' => 'required|max:30',
            'email' => 'required|unique:user,email',
            'password' => 'required|max:12',
            'konfirmasiPassword' => 'same:password|required',
            'noTelp' => 'required|max:15|min:12',
            'alamat' => 'required|max:150',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User;

        $user->nama_lengkap = $request->namaLengkap;
        $user->email = $request->email;
        $user->password = hash::make($request->password);
        $user->userType = 0;
        $user->notelp = $request->noTelp;
        $user->alamat = $request->alamat;
        $user->save();

        if ($user) {
            return redirect('/login');
        } else {
            return redirect()->back()->withErrors(['message' => 'Data yang dimasukkan Invalid'])->withInput();
        }
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|exists:user,email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $usertype = Auth::user()->userType;
            if ($usertype = "1") {
                return redirect()->intended('/admin');
            }
            return redirect()->intended('/produk');
        }

        return back()->withErrors(['message' => 'Username atau Password salah!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Berhasil Logout!');
        // return response()->json([
        //     'message' => 'logout',
        // ]);
    }
}