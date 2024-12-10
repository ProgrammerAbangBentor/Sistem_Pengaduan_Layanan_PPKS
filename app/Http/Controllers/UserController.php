<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role; // Pastikan ini diimpor

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('users')
            ->when($request->input('name'), function ($query, $name) {
                $query->where('name', 'like', '%' . $name . '%')
                    ->orWhere('email', 'like', '%' . $name . '%');
            })
            ->orderByRaw("CASE
                WHEN role = 'admin' THEN 1
                WHEN role = 'anggota' THEN 2
                WHEN role = 'user' THEN 3
                ELSE 4
            END") // Membuat agar usernya berurutan
            ->paginate(10);

        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        // Ambil semua role untuk dropdown
        $roles = Role::all();
        return view('pages.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,anggota,user',
        ]);

         // Create user
         $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
         // Assign role
         $user->assignRole($request->role);

         return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function profil($id)
    {
        $user = User::findOrFail($id);

        return view('pages.users.profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        // Validasi input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
        ]);

        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Perbarui data jika ada perubahan
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Jika password diisi, hash dan update password
        if ($request->filled('password')) { // Mengecek apakah password diisi
            $user->password = Hash::make($request->input('password'));
        }

        // Simpan perubahan ke database
        $user->save();

        // Redirect ke profil dengan pesan sukses
        return redirect()->route('user.profil', $id)->with('success', 'Profile updated successfully');
   }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        // Ambil semua role untuk dropdown
        $roles = Role::all();
        return view('pages.users.edit', compact('user', 'roles'));
    }

        //update
        public function update(Request $request, $id)
        {
        $data = $request->all();
        $user = User::findOrFail($id);

        //check if password is not empty
        if ($request->input('password')) {
            $data['password'] = Hash::make($request->input('password'));
        } else {
            //if password is empty, then use the old password
            $data['password'] = $user->password;
        }
        $user->update($data);
        $user->assignRole($request->role);
        return redirect()->route('user.index') ->with('success', 'User updated successfully');

        }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }

    // app/Http/Controllers/UserController.php
public function toggleActive($id)
{
    $user = User::findOrFail($id);
    $user->is_active = !$user->is_active;  // Membalik status aktif
    $user->save();

    return redirect()->route('user.index')->with('success', 'Akun berhasil diperbarui.');
}

}
