<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert as SweetAlert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::query();

        // Filter berdasarkan nama pengguna
        if ($request->has('search')) {
            $users->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $users = $users->get();

        return view('pages.search.index_user', compact('users'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->input('password'));

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Data Berhasil Ditambahkan');
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
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'old_password' => 'nullable|string|min:8',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Validasi password lama di sisi server
        if ($request->filled('old_password') && !Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->back()->with('error', 'Password Lama Tidak Sesuai.');
        }


        $data = $request->all();

        // Validasi password baru dan konfirmasi password baru
        if ($request->filled('password') && $request->input('password') !== $request->input('password_confirmation')) {
            return redirect()->back()->with('error', 'Password Baru dan Konfirmasi Password Baru Tidak Sesuai.');
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Data Berhasil Diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data Berhasil Dihapus');
    }
}
