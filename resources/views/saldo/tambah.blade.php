@extends('layouts.admin')

@section('title', 'Tambah Saldo')

@section('content')

<div class="container-fluid mt-3 px-2 px-md-3">
    <div class="row">
        <div class="col-12 col-md-6">

            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-primary text-white py-2">
                    <h6 class="mb-0">Tambah Saldo</h6>
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
                        <div class="alert alert-info py-2">
                            Saldo akhir: 
                            <strong>
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

                        {{-- Username --}}
                        <div class="mb-3">
                            <label class="form-label">User</label>
                            <select name="username" class="form-control form-control-lg" required>
                                <option value="">-- Pilih User --</option>
                                @foreach($users as $u)
                                    <option value="{{ $u->username }}" 
                                        {{ old('username') == $u->username ? 'selected' : '' }}>
                                        {{ $u->nama_lengkap }} ({{ $u->username }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Jumlah --}}
                        <div class="mb-3">
                            <label class="form-label">Jumlah Saldo</label>
                            <input type="text" 
                                   name="jumlah" 
                                   id="jumlah"
                                   class="form-control form-control-lg"
                                   placeholder="Contoh: 20.000"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-2">
                            💾 Tambah Saldo
                        </button>

                    </form>

                    <hr>

                    {{-- TABEL --}}
                    <h6 class="mt-3 mb-2">Data Saldo User</h6>

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover">
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
                                        <td colspan="3" class="text-center">
                                            Tidak ada data user
                                        </td>
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

{{-- SCRIPT FORMAT RUPIAH --}}
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