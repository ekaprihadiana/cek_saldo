<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaldoController extends Controller
{
   // tampilkan form
    public function formTambahSaldo()
    {
        return view('saldo.tambah');
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

            // lock tabungan (anti bentrok)
            $tabungan = DB::table('tabungan')
                ->where('user_id', $targetUser->id)
                ->lockForUpdate()
                ->first();

            if (!$tabungan) {
                DB::rollBack();
                return back()->with('error', 'Data tabungan tidak ditemukan');
            }

            // update saldo
            DB::table('tabungan')
                ->where('user_id', $targetUser->id)
                ->update([
                    'saldo' => ($tabungan->saldo ?? 0) + $request->jumlah
                ]);

            // simpan transaksi
            DB::table('transaksi')->insert([
                'user_id' => $targetUser->id,
                'jenis' => 'masuk',
                'jumlah' => $request->jumlah,
                'created_at' => now()
            ]);

            DB::commit();

            return back()->with('success', 'Saldo berhasil ditambahkan ke ' . $targetUser->username);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }
}
