@extends('layouts.admin')

@section('title', 'Register User')

@section('content')

<div class="ms-3" style="max-width: 500px;">

    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-4 text-center">Register User</h4>

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ERROR --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/users/register" autocomplete="off">
                @csrf

                {{-- USERNAME --}}
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                {{-- PASSWORD --}}
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                {{-- NAMA --}}
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>

                {{-- BUTTON --}}
                <button type="submit" class="btn btn-primary w-100">
                    Register
                </button>

            </form>

        </div>
    </div>

</div>

@endsection