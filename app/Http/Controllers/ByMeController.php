<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\cart;
use App\Models\product;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


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
        $products = product::where('id_produk', $id)->first();
        return view('frontend.detailProduk', compact('products'));
    }


    // cart related
    public function viewCart()
    {
        $products = product::all();
        $cartList = cart::where('id_user', Auth::user()->id_user)->where('status_produk', 'not purchased')->get();
        return view('frontEnd.keranjang', compact('cartList'));
    }

    public function addToCart(Request $request, $id_produk)
    {
        $quantity = (int) $request->input('quantity');
        $product = product::where('id_produk', $id_produk)->first();

        // Cek apakah produk sudah ada di keranjang untuk pengguna yang sama
        $cartItem = cart::where('id_user', Auth::user()->id_user)
            ->where('id_produk', $product->id_produk)
            ->where('status_produk', 'not purchased')
            ->first();

        if ($cartItem) {
            // Jika produk sudah ada di keranjang, update jumlah produk
            $newQuantity = $cartItem->quantity + $quantity;
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            // Jika produk belum ada di keranjang, tambahkan produk baru ke dalam keranjang
            $newItem = new cart([
                'id_user' => Auth::user()->id_user,
                'id_produk' => $product->id_produk,
                'id_order' => null,
                'status_produk' => 'not purchased',
                'quantity' => $quantity,
            ]);
            $newItem->save();
        }

        return redirect()->back();
    }

    public function removeItem($id_cart)
    {
        // Perubahan: Ubah whereIn menjadi find
        $cartItem = cart::find($id_cart);

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->back();
        }

        abort(404);
    }
}