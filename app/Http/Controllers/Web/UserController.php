<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function create()
    {
        return view('users.register');
    }
    

    public function store(Request $request)
{
    try {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'nama_lengkap' => 'required',
        ]);

        DB::beginTransaction();

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'api_token' => Str::random(80),
        ]);
// dd($user);
        // DB::table('tabungan')->insert([
        //     'user_id' => $user->id,
        //     'saldo' => 0,
        //     'created_at' => now()
        // ]);
        try {
    DB::table('tabungan')->insert([
        'user_id' => $user->id,
        'saldo' => 0,
        'created_at' => now()
    ]);

    // dd('TABUNGAN BERHASIL');

} catch (\Exception $e) {
    dd($e->getMessage()); // 🔥 PASTI KETANGKAP ERROR ASLI
}

        DB::commit();
dd('USER MASUK');
        return redirect()->back()->with('success', 'User berhasil dibuat');

    } catch (\Exception $e) {

        DB::rollBack();

        return redirect()->back()
            ->with('error', $e->getMessage())
            ->withInput();
    }
}
}