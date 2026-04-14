@extends('layouts.app')

@section('title', 'Tabunganku - Login')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="height:100vh;">

    <div class="card shadow-lg border-0 p-4" style="width: 100%; max-width: 380px; border-radius: 16px;">

        <!-- Header Judul -->
        <div class="text-center mb-4">
            <div style="width:55px;height:55px;margin:auto;background:#0d6efd;border-radius:50%;"></div>

            <h4 class="mt-3 mb-0 fw-bold text-primary">
                Tabunganku
            </h4>

            <small class="text-muted">
                Aplikasi pencatatan tabungan
            </small>
        </div>

        <!-- Error -->
        @if(session('error'))
            <div class="alert alert-danger py-2">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="/login">
            @csrf

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password">
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 rounded-3">
                Login
            </button>

        </form>

    </div>

</div>

@endsection
