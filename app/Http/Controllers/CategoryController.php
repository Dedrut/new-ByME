<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\category;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = category::all();
        return view('frontend.admin.admin_category', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'inCategoryName' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori Gagal ditambahkan',
                'errors' => $validator->errors()
            ], 422);
        }

        $newCategory = new category([
            'nama_category' => $request->inCategoryName
        ]);

        $newCategory->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_category)
    {
        $category = category::find($id_category);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ada'
            ], 404);
        }

        $category->delete();
        return redirect()->back();
    }
}