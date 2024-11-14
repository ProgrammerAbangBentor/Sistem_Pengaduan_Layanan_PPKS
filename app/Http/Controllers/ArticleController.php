<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikels = Artikel::all();
        return view('pages.artikel.index', compact('artikels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $data = $request->all();

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('articles', 'public');
            }

            Artikel::create($data);
            return redirect()->route('article.index')->with('success', 'Artikel created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('pages.artikel.edit', compact('artikel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $artikel = Artikel::findOrFail($id);
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($artikel->image && Storage::disk('public')->exists($artikel->image)) {
                Storage::disk('public')->delete($artikel->image);
            }
            $data['image'] = $request->file('image')->store('articles', 'public');
        } else {
            // Gunakan gambar lama jika tidak ada gambar baru yang diunggah
            $data['image'] = $artikel->image;
        }

        $artikel->update($data);

        return redirect()->route('article.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artikel $artikel)
    {
        $artikel->delete();
        return redirect()->route('article.index')->with('success', 'Artikel deleted successfully.');
    }
}
