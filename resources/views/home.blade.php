@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<h2>Dashboard</h2>

<p>Selamat datang, <b>{{ session('user')->username }}</b></p>

<div class="card mt-3">
    <div class="card-body">
        Ini halaman admin dashboard
    </div>
</div>

@endsection