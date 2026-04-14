@php
    $segment = request()->segment(1);
@endphp


<!-- Dashboard -->
<a href="/dashboard"
   class="sidebar-link {{ $segment == 'dashboard' ? 'active-menu' : '' }}">
   ðŸ“Š Dashboard
</a>

<!-- Registrasi User -->
<a href="/users/register"
   class="sidebar-link {{ request()->is('users/register') ? 'active-menu' : '' }}">
   👤 Register User
</a>

<!-- Create Tabungan -->
<a href="/tabungan/create"
   class="sidebar-link {{ $segment == 'tabungan' && request()->is('tabungan/create') ? 'active-menu' : '' }}">
   ðŸ’° Create Tabungan
</a>

<!-- Data Tabungan -->
<a href="/tabungan"
   class="sidebar-link {{ $segment == 'tabungan' && request()->is('tabungan') ? 'active-menu' : '' }}">
   ðŸ“„ Data Tabungan
</a>

<hr>

<a href="/logout" class="sidebar-link text-danger">
    ðŸšª Logout
</a>