<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role; // Pastikan ini diimpor
use Illuminate\Support\Facades\Storage;

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
            'no_identitas' => 'required|string|unique:users,no_identitas',
            'email' => 'required|email|unique:users',
            'email_penerima_akun' => 'required|email|unique:users',
            // 'password' => 'nullable|min:8',
            'role' => 'required|in:admin,anggota,user',
        ]);

         // Create user
         $user = User::create([
            'name' => $request->name,
            'no_identitas' => $request->no_identitas,
            'email' => $request->email,
            'email_penerima_akun' => $request->email_penerima_akun,
            // 'password' => Hash::make($request->password),
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
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6|confirmed', // Validasi password jika diisi
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);
    
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);
    
        // Perbarui data jika ada perubahan
        $user->name = $request->input('name');
        $user->email = $request->input('email');
    
        // Jika password diisi, hash dan update password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
    
        // Proses upload gambar profil jika ada file
        if ($request->hasFile('profile_image')) {
            // Hapus gambar profil lama jika ada
            if ($user->profile_image && Storage::exists('public/images/profile/' . $user->profile_image)) {
                Storage::delete('public/images/profile/' . $user->profile_image); // Hapus file lama
            }
    
            // Simpan gambar baru
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Menghasilkan nama unik untuk file gambar
            $image->storeAs('public/images/profile', $imageName); // Simpan gambar ke storage
    
            // Simpan nama file gambar ke database
            $user->profile_image = $imageName;
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
        
            // Cek apakah password diisi atau tidak
            if ($request->input('password')) {
                $data['password'] = Hash::make($request->input('password'));
            } else {
                // Jika password tidak diisi, gunakan password lama
                $data['password'] = $user->password;
            }
        
            // Update data user
            $user->update($data);
        
            // Hapus semua role sebelumnya dan tambahkan role baru
            $user->roles()->detach();
            $user->assignRole($request->role);
        
            return redirect()->route('user.index')->with('success', 'User updated successfully');
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


 // Method untuk mengambil email berdasarkan no_identitas
 public function getEmailByNoIdentitas(Request $request)
 {
     // Validasi input no_identitas
     $request->validate([
         'no_identitas' => 'required|string',
     ]);

     // Cari user berdasarkan no_identitas
     $user = User::where('no_identitas', $request->no_identitas)->first();

     // Jika user ditemukan, kirimkan email_penerima_akun
     if ($user) {
         return response()->json([
             'email_penerima_akun' => $user->email_penerima_akun,
         ]);
     }

     // Jika tidak ditemukan, kirimkan response kosong
     return response()->json([
         'email_penerima_akun' => null,
     ]);
 }


}
