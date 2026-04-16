@extends('layouts.app')

@section('title', 'Tambah Saldo')

@section('content')

<div class="container mt-5">
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

            {{-- Form --}}
            <form method="POST" action="/tambah-saldo">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username">
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Saldo</label>
                    <input type="number" name="jumlah" class="form-control" placeholder="Masukkan jumlah">
                </div>

                <button type="submit" class="btn btn-success">
                    Tambah Saldo
                </button>

            </form>

        </div>
    </div>
</div>

@endsection