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
                                    {{ $u->name }} ({{ $u->username }})
                                </option>
                            @endforeach
                        </select>
                        </div>

                        {{-- Jumlah --}}
                        <div class="mb-3">
                            <label class="form-label">Jumlah Saldo</label>
                            <input type="number" 
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
                                    <td>{{ $u->name ?? '-' }}</td>
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

@endsection