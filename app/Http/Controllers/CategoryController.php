<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'nullable',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }



    public function edit(Category $category)
    {
        return view('pages.categories.edit', compact('category'));
    }

     // Memperbarui kategori
     public function update(Request $request, Category $category)
     {
         $request->validate([
             'name' => 'required|max:255|unique:categories,name,' . $category->id,
             'description' => 'nullable',
         ]);

         $category->update($request->all());

         return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
     }


     public function destroy(Category $category, Request $request)
     {
        try {
            // Cek apakah kategori masih digunakan di relasi lain (misalnya model Pengaduan)
            if ($category->pengaduans()->exists()) {
                return redirect()->back()->with('error', 'Kategori ini tidak bisa dihapus karena masih digunakan pada pengaduan.');
            }
    
            // Jika tidak ada relasi yang menggunakan kategori, maka hapus kategori
            $category->delete();
    
            return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan Karena Categori Masih di pakai:' . $e->getMessage());
        }
    }
}
