@extends('layouts.admin')

@section('title', 'Tambah Saldo')

@section('content')

<div class="container-fluid mt-2 px-1 px-md-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            {{-- CARD --}}
            <div class="card shadow-sm rounded-3 w-100 border-0">

                {{-- HEADER --}}
                <div class="card-header bg-primary text-white py-3 text-center">
                    <h5 class="mb-0">💰 Tambah Saldo</h5>
                </div>

                <div class="card-body">

                    {{-- Alert --}}
                    @if(session('success'))
                        <div class="alert alert-success py-2">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger py-2">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Saldo terakhir --}}
                    @if(session('last_saldo'))
                        <div class="alert alert-info text-center py-2">
                            Saldo akhir:<br>
                            <strong style="font-size:20px;">
                                Rp {{ number_format(session('last_saldo'), 0, ',', '.') }}
                            </strong>
                        </div>
                    @endif

                    {{-- Error validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-warning py-2">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form method="POST" action="/tambah-saldo">
                        @csrf

                        {{-- USER --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">User</label>
                            <select name="username" 
                                    class="form-control"
                                    style="height:55px; font-size:16px;"
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
                            <label class="form-label fw-bold">Jumlah Saldo</label>
                            <input type="text" 
                                   name="jumlah" 
                                   id="jumlah"
                                   class="form-control"
                                   style="height:60px; font-size:20px;"
                                   placeholder="Contoh: 20.000"
                                   required>
                        </div>

                        {{-- BUTTON --}}
                        <button type="submit" 
                                class="btn btn-success w-100"
                                style="height:60px; font-size:18px;">
                            💾 Tambah Saldo
                        </button>

                    </form>

                    <hr>

                    {{-- TABEL --}}
                    <h6 class="mt-3 mb-2 text-center">Data Saldo User</h6>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $u)
                                    <tr>
                                        <td>{{ $u->nama_lengkap ?? '-' }}</td>
                                        <td>{{ $u->username }}</td>
                                        <td>
                                            <span class="badge bg-success">
                                                Rp {{ number_format($u->saldo ?? 0, 0, ',', '.') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- FORMAT RUPIAH --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    const input = document.getElementById('jumlah');
    if (!input) return;

    input.addEventListener('blur', function() {
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
    });

    input.addEventListener('focus', function() {
        let value = this.value.replace(/\./g, '').replace(',', '.');
        this.value = value;
    });

});
</script>

@endsection