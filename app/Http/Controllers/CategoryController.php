<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Kategori_pengaduan;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Kategori_pengaduan::paginate(5);
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

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dibuat.');
    }

    public function edit(Kategori_pengaduan $category)
    {
        return view('pages.categories.edit', compact('category'));
    }

    public function update(Request $request, Kategori_pengaduan $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:kategori_pengaduan,name,' . $category->id,
            'keterangan' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori_pengaduan $category)
    {
        try {
            // Periksa apakah kategori masih digunakan di model Pengaduan (jika ada relasi)
            if (method_exists($category, 'pengaduan') && $category->pengaduan()->exists()) {
                return redirect()->back()->with('error', 'Kategori ini tidak bisa dihapus karena masih digunakan pada pengaduan.');
            }

            $category->delete();

            return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
