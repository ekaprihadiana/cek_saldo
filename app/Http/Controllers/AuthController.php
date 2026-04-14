<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|unique:users,username',
                'password' => 'required|min:6',
                'nama_lengkap' => 'required'
            ]);

            DB::beginTransaction();

            $userId = DB::table('users')->insertGetId([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'nama_lengkap' => $request->nama_lengkap,
                'created_at' => now()
            ]);

            DB::table('tabungan')->insert([
                'user_id' => $userId,
                'saldo' => 0,
                'created_at' => now()
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Register berhasil + tabungan dibuat'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function tambahSaldo(Request $request)
{
    try {
        $request->validate([
            'username' => 'required',
            'jumlah' => 'required|numeric|min:1'
        ]);

        // ambil token dari header
        $token = $request->header('Authorization');

        $userLogin = DB::table('users')
            ->where('api_token', $token)
            ->first();

        if (!$userLogin) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ]);
        }

        // cari user berdasarkan username
        $targetUser = DB::table('users')
            ->where('username', $request->username)
            ->first();

        if (!$targetUser) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan'
            ]);
        }

        DB::beginTransaction();

        // ambil tabungan
        $tabungan = DB::table('tabungan')
            ->where('user_id', $targetUser->id)
            ->first();

        // update saldo
        DB::table('tabungan')
            ->where('user_id', $targetUser->id)
            ->update([
                'saldo' => $tabungan->saldo + $request->jumlah
            ]);

        // simpan transaksi
        DB::table('transaksi')->insert([
            'user_id' => $targetUser->id,
            'jenis' => 'masuk',
            'jumlah' => $request->jumlah,
            'created_at' => now()
        ]);

        DB::commit();

        return response()->json([
            'status' => true,
            'message' => 'Saldo berhasil ditambahkan ke ' . $targetUser->username
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}
    public function login(Request $request)
{
    try {
        // validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // cari user berdasarkan username
        $user = DB::table('users')
            ->where('username', $request->username)
            ->first();

        // cek apakah user ada & password cocok
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Username atau password salah'
            ]);
        }

        // generate token baru
        $token = Str::random(60);

        // simpan token ke database
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'api_token' => $token
            ]);

        // response ke client (Flutter/Postman)
        return response()->json([
            'status' => true,
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'nama_lengkap' => $user->nama_lengkap
            ]
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}
public function cekSaldo($username, Request $request)
{
    try {
        // ambil token dari header
        $token = $request->header('Authorization');

        $userLogin = DB::table('users')
            ->where('api_token', $token)
            ->first();

        if (!$userLogin) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ]);
        }

        // ambil user target
        $user = DB::table('users')
            ->where('username', $username)
            ->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan'
            ]);
        }

        // ambil tabungan
        $tabungan = DB::table('tabungan')
            ->where('user_id', $user->id)
            ->first();

        // ambil transaksi
        $transaksi = DB::table('transaksi')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'saldo' => $tabungan ? $tabungan->saldo : 0,
            'transaksi' => $transaksi
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}

public function lupaPassword(Request $request)
{
    try {
        $request->validate([
            'username' => 'required',
            'password_baru' => 'required|min:6'
        ]);

        $user = DB::table('users')
            ->where('username', $request->username)
            ->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan'
            ]);
        }

        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'password' => Hash::make($request->password_baru)
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Password berhasil diubah'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ]);
    }
}
}