@extends('layouts.admin')

@section('title', 'Register User')

@section('content')

<div class="container">

    <h2 class="mb-3">Register User</h2>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR VALIDATION --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-4">

        <form method="POST" action="/users/register">

            @csrf

            {{-- USERNAME --}}
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            {{-- PASSWORD --}}
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            {{-- NAMA LENGKAP --}}
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>

            {{-- BUTTON --}}
            <button type="submit" class="btn btn-primary w-100">
                Register User
            </button>

        </form>

    </div>

</div>

@endsection