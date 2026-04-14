@php
    $segment = request()->segment(1);
@endphp

<div class="sidebar-container">
    @php $segment = request()->segment(1); @endphp

    <a href="/dashboard" class="sidebar-link {{ request()->is('dashboard*') ? 'active-menu' : '' }}">
        <span>📊</span> Dashboard
    </a>

    <a href="/users/register" class="sidebar-link {{ request()->is('users/register') ? 'active-menu' : '' }}">
        <span>👤</span> Register
    </a>

    <a href="/tabungan/create" class="sidebar-link {{ request()->is('tabungan/create') ? 'active-menu' : '' }}">
        <span>💰</span> Create
    </a>

    <a href="/tabungan" class="sidebar-link {{ request()->is('tabungan') ? 'active-menu' : '' }}">
        <span>📄</span> Data
    </a>

    <hr>

    <a href="/logout" class="sidebar-link text-danger">
        <span>🚪</span> Logout
    </a>
</div>