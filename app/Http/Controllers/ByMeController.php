<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\product;

class ByMeController extends Controller
{
    //Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
    // end Logout

    public function index()
    {
        $products = product::all();
        return view('frontend.home', compact('products'));
    }

    public function detailProduk($id)
    {
        $products = product::find($id);
        return view('frontend.detailProduk', compact('products'));
    }
}