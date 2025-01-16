<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Kategori_pengaduan;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Kategori_pengaduan::all();
        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:kategori_pengaduan|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Kategori_pengaduan::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }



    public function edit(Kategori_pengaduan $category)
    {
        return view('pages.categories.edit', compact('category'));
    }

     // Memperbarui kategori
     public function update(Request $request, Kategori_pengaduan $category)
     {
         $request->validate([
             'name' => 'required|max:255|unique:categories,name,' . $category->id,
             'description' => 'nullable',
         ]);

         $category->update($request->all());

         return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
     }


     public function destroy(Kategori_pengaduan $category, Request $request)
     {
        try {
            // Cek apakah kategori masih digunakan di relasi lain (misalnya model Pengaduan)
            if ($category->pengaduan()->exists()) {
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
