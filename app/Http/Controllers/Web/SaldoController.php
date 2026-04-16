<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaldoController extends Controller
{
    // ✅ tampilkan form + data user
    public function formTambahSaldo()
    {
        $users = DB::table('users')
            ->leftJoin('tabungan', 'users.id', '=', 'tabungan.user_id')
            ->select('users.username','users.nama_lengkap', 'tabungan.saldo')
            ->get();

        return view('saldo.tambah', compact('users'));
    }

    // proses tambah saldo
    public function tambahSaldo(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'jumlah' => 'required|numeric|min:1'
            ]);

            // cari user
            $targetUser = DB::table('users')
                ->where('username', $request->username)
                ->first();

            if (!$targetUser) {
                return back()->with('error', 'User tidak ditemukan');
            }

            DB::beginTransaction();

            // lock tabungan
            $tabungan = DB::table('tabungan')
                ->where('user_id', $targetUser->id)
                ->lockForUpdate()
                ->first();

            if (!$tabungan) {
                DB::rollBack();
                return back()->with('error', 'Data tabungan tidak ditemukan');
            }

            // hitung saldo baru
            $saldoBaru = ($tabungan->saldo ?? 0) + $request->jumlah;

            // update saldo
            DB::table('tabungan')
                ->where('user_id', $targetUser->id)
                ->update([
                    'saldo' => $saldoBaru
                ]);

            // simpan transaksi
            DB::table('transaksi')->insert([
                'user_id' => $targetUser->id,
                'jenis' => 'masuk',
                'jumlah' => $request->jumlah,
                'created_at' => now()
            ]);

            DB::commit();

            // 🔥 redirect + kirim saldo terakhir
            return redirect('/tambah-saldo')
                ->with('success', 'Saldo berhasil ditambahkan ke ' . $targetUser->username)
                ->with('last_saldo', $saldoBaru);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}