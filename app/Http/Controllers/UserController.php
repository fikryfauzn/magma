<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.manage_user', compact('users'));
    }

    // Menampilkan halaman edit user
    public function edit($id)
    {
        // Ambil data user berdasarkan ID
        $user = User::findOrFail($id);

        // Kembalikan view dengan data user
        return view('admin.edit.edituser', compact('user'));
    }

    // Mengupdate data user
    public function update(Request $request, $id)
    {
        // Temukan user berdasarkan ID
        $user = User::find($id);

        // Jika user tidak ditemukan, redirect ke halaman daftar user dengan pesan error
        if (!$user) {
            return redirect()->route('admin.manage_user')->with('error', 'User not found.');
        }

        // Update data user
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        // Update field lain sesuai kebutuhan

        // Simpan perubahan
        $user->save();

        // Redirect kembali ke halaman daftar user setelah berhasil update
        return redirect()->route('admin.manage_user')->with('success', 'User updated successfully');
    }

    // Menghapus user
    public function destroy($id)
    {
        try {
            // Cari user berdasarkan ID
            $user = User::findOrFail($id);

            // Hapus user
            $user->delete();

            // Redirect kembali ke halaman daftar user
            return redirect()->route('admin.manage_user')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.manage_user')->with('error', 'Failed to delete user.');
        }
    }
}
