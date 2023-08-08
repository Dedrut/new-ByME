<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;




class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = product::all();
        $category = category::all();
        return view('backend.product', compact('products', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inCategoryName' => 'required',
            'inProductName' => 'required',
            'inDeskripsi' => 'required',
            'inGambar' => 'required',
            'inJumlah' => 'required|numeric',
            'inHarga' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Produk gagal ditambahkan!',
                'errors' => $validator->errors()
            ], 422);
        }

        $newProduct = new product([
            'nama_produk' => $request->inProductName,
            'deskripsi' => $request->inDeskripsi,
            'gambar' => $request->inGambar,
            'id_category' => $request->inCategoryName,
            'jumlah' => $request->inJumlah,
            'harga' => $request->inHarga
        ]);

        // if ($request->hasFile('inGambar')) {
        //     $path = public_path('\images\produk', 'inGambar');
        //     $file = $request->file('inGambar');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = md5(time()) . '.' . $extension;
        //     $file->move($path, $filename);
        //     $newProduct->gambar = $filename;
        // }
        if ($request->hasFile('inGambar')) {
            $path = public_path('\images\produk', 'inGambar');
            $file = $request->file('inGambar');
            $extension = $file->getClientOriginalExtension();
            $filename = md5(time()) . '.' . $extension;
            $file->move($path, $filename);
            $newProduct->gambar = $filename;
        }


        $newProduct->save();
        return redirect()->back();
    }

    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $products = product::find($id);
        return response()->json($products);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->idProduk;
        $validator = Validator::make($request->all(), [
            'editCategoryName' => 'required',
            'editProductName' => 'required',
            'editDeskripsi' => 'required',
            'editGambar' => 'max:50000', // Ubah batasan ukuran file sesuai kebutuhan
            'editJumlah' => 'required',
            'editHarga' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = product::findOrFail($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $product->nama_produk = $request->editProductName;
        $product->deskripsi = $request->editDeskripsi;
        $product->id_category = $request->editCategoryName;
        $product->jumlah = $request->editJumlah;
        $product->harga = $request->editHarga;



        if ($request->hasFile('editGambar')) {
            $path = public_path('\images\produk', 'editGambar');
            $file = $request->file('editGambar');
            $extension = $file->getClientOriginalExtension();
            $filename = md5(time()) . '.' . $extension;
            $file->move($path, $filename);
            $product->gambar = $filename;
        }


        $product->save();
        return redirect()->route('product-page')->with('success', 'Produk berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_produk)
    {
        $product = Product::find($id_produk);


        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Hapus gambar terkait dari direktori public/images/produk
        $gambarPath = public_path('\images\produk' . $product->gambar);
        if (file_exists($gambarPath)) {
            unlink($gambarPath);
        }

        // Hapus data produk dari database
        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus.');
    }
}