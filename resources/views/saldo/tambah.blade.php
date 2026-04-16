@extends('layouts.admin')

@section('title', 'Tambah Saldo')

@section('content')

<div class="container-fluid px-2 px-md-4 py-2">

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">

            {{-- CARD (desktop) / FULL (mobile) --}}
            <div class="card shadow-sm border-0 rounded-0 rounded-md-3">

                {{-- HEADER --}}
                <div class="card-header bg-primary text-white text-center py-3">
                    <h5 class="mb-0">💰 Tambah Saldo</h5>
                </div>

                <div class="card-body px-3 px-md-4">

                    {{-- ALERT --}}
                    @if(session('success'))
                        <div class="alert alert-success py-2 text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger py-2 text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- SALDO TERAKHIR --}}
                    @if(session('last_saldo'))
                        <div class="bg-light rounded-3 p-3 text-center mb-3">
                            <small class="text-muted">Saldo Akhir</small>
                            <div style="font-size:22px; font-weight:bold;">
                                Rp {{ number_format(session('last_saldo'), 0, ',', '.') }}
                            </div>
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form method="POST" action="/tambah-saldo">
                        @csrf

                        {{-- USER --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">User</label>
                            <select name="username" 
                                    class="form-control form-control-lg"
                                    required>
                                <option value="">-- Pilih User --</option>
                                @foreach($users as $u)
                                    <option value="{{ $u->username }}">
                                        {{ $u->nama_lengkap }} ({{ $u->username }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- JUMLAH --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah</label>
                            <input type="text" 
                                   name="jumlah" 
                                   id="jumlah"
                                   class="form-control form-control-lg text-center"
                                   style="font-size:22px;"
                                   placeholder="0"
                                   required>
                        </div>

                        {{-- BUTTON --}}
                        <button type="submit" 
                                class="btn btn-success w-100 py-3"
                                style="font-size:18px;">
                            💾 Tambah Saldo
                        </button>

                    </form>

                </div>
            </div>

            {{-- LIST USER --}}
            <div class="mt-3">

                <h6 class="text-center mb-2">Data Saldo User</h6>

                <div class="bg-white rounded shadow-sm">

                    @foreach($users as $u)
                        <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                            <div>
                                <div class="fw-bold">{{ $u->nama_lengkap ?? '-' }}</div>
                                <small class="text-muted">{{ $u->username }}</small>
                            </div>
                            <div class="text-success fw-bold">
                                Rp {{ number_format($u->saldo ?? 0, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </div>
    </div>
</div>

@endsection


{{-- SCRIPT WAJIB DI BAWAH --}}
@section('script')
<script>
document.addEventListener("DOMContentLoaded", function () {

    const input = document.getElementById('jumlah');
    if (!input) return;

    function formatRupiah() {
        let value = this.value.replace(/[^0-9,]/g, '');
        if (!value) return;

        let parts = value.split(',');
        let angka = parts[0];
        let desimal = parts[1];

        let sisa = angka.length % 3;
        let rupiah = angka.substr(0, sisa);
        let ribuan = angka.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        if (desimal !== undefined) {
            rupiah += ',' + desimal.substring(0,2);
        }

        this.value = rupiah;
    }

    // 🔥 support HP + desktop
    input.addEventListener('blur', formatRupiah);
    input.addEventListener('change', formatRupiah);

    input.addEventListener('focus', function() {
        this.value = this.value.replace(/\./g, '').replace(',', '.');
    });

});
</script>
@endsection