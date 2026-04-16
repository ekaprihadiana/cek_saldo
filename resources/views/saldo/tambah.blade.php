@extends('layouts.admin')

@section('title', 'Tambah Saldo')

@section('content')

<div class="container-fluid mt-3 px-3">
    <div class="row">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5>Tambah Saldo</h5>
                </div>

                <div class="card-body">

                    {{-- Alert --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Saldo terakhir --}}
                    @if(session('last_saldo'))
                        <div class="alert alert-info">
                            Saldo akhir: 
                            <strong>
                                Rp {{ number_format(session('last_saldo'), 0, ',', '.') }}
                            </strong>
                        </div>
                    @endif

                    {{-- Error validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-warning">
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
                            <label class="form-label">Username</label>
                            <select name="username" class="form-control" required>
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
                                   class="form-control"
                                   value="{{ old('jumlah') }}"
                                   placeholder="Masukkan jumlah"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-success">
                            Tambah Saldo
                        </button>

                    </form>

                    <hr>

                    {{-- TABEL SALDO USER --}}
                    <h6>Data Saldo User</h6>

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
                                    <td colspan="2" class="text-center">
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

<script>
    const input = document.getElementById('jumlah');

    input.addEventListener('keyup', function(e) {
        let value = this.value.replace(/[^0-9,]/g, '');

        // pisahkan angka dan desimal
        let parts = value.split(',');
        let angka = parts[0];
        let desimal = parts[1];

        // format ribuan
        let sisa = angka.length % 3;
        let rupiah = angka.substr(0, sisa);
        let ribuan = angka.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        // gabungkan desimal
        if (desimal !== undefined) {
            rupiah += ',' + desimal.substring(0,2);
        }

        this.value = rupiah;
    });
</script>

@endsection