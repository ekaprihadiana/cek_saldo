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
            'jumlah' => 'required'
        ]);

        // 🔥 convert rupiah ke angka
        $jumlah = str_replace('.', '', $request->jumlah);
        $jumlah = str_replace(',', '.', $jumlah);
        $jumlah = (float) $jumlah;

        $targetUser = DB::table('users')
            ->where('username', $request->username)
            ->first();

        if (!$targetUser) {
            return back()->with('error', 'User tidak ditemukan');
        }

        DB::beginTransaction();

        $tabungan = DB::table('tabungan')
            ->where('user_id', $targetUser->id)
            ->lockForUpdate()
            ->first();

        if (!$tabungan) {
            DB::rollBack();
            return back()->with('error', 'Data tabungan tidak ditemukan');
        }

        $saldoBaru = ($tabungan->saldo ?? 0) + $jumlah;

        DB::table('tabungan')
            ->where('user_id', $targetUser->id)
            ->update([
                'saldo' => $saldoBaru
            ]);

        DB::table('transaksi')->insert([
            'user_id' => $targetUser->id,
            'jenis' => 'masuk',
            'jumlah' => $jumlah,
            'created_at' => now()
        ]);

        DB::commit();

        return redirect('/tambah-saldo')
            ->with('success', 'Saldo berhasil ditambahkan')
            ->with('last_saldo', $saldoBaru);

    } catch (\Exception $e) {

        DB::rollBack();

        return back()->with('error', $e->getMessage());
    }
    }
}