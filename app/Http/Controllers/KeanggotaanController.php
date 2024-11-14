<?php

namespace App\Http\Controllers;

use App\Models\Keanggotaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KeanggotaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggota = Keanggotaan::all();
        return view('pages.keanggotaan.index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.keanggotaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'no_telp' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('anggota', 'public');
        }

        Keanggotaan::create($data);
        return redirect()->route('anggota.index')->with('success', 'Anggota created successfully.');
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
        $anggota = Keanggotaan::findOrFail($id);
        return view('pages.keanggotaan.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'no_telp' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $anggota = Keanggotaan::findOrFail($id);
        $anggota->name = $request->name;
        $anggota->jabatan = $request->jabatan;
        $anggota->status = $request->status;
        $anggota->no_telp = $request->no_telp;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($anggota->image && Storage::disk('public')->exists($anggota->image)) {
                Storage::disk('public')->delete($anggota->image);
            }
            $anggota->image = $request->file('image')->store('anggota', 'public');
        }

        $anggota->save();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $anggota = Keanggotaan::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota deleted successfully.');
    }
}
