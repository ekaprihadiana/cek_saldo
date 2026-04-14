@php
    // Kita gunakan helper request()->is() langsung di class agar lebih fleksibel
@endphp

<a href="/dashboard"
   class="sidebar-link {{ request()->is('dashboard*') ? 'active-menu' : '' }}">
   📊 Dashboard
</a>

<a href="/users/register"
   class="sidebar-link {{ request()->is('users/register') ? 'active-menu' : '' }}">
   👤 Register User
</a>

<a href="/tabungan/create"
   class="sidebar-link {{ request()->is('tabungan/create') ? 'active-menu' : '' }}">
   💰 Create Tabungan
</a>

<a href="/tabungan"
   class="sidebar-link {{ request()->is('tabungan') ? 'active-menu' : '' }}">
   📄 Data Tabungan
</a>

<hr>

<form action="/logout" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="sidebar-link text-danger border-0 bg-transparent" style="cursor: pointer; width: 100%; text-align: left;">
        🚪 Logout
    </button>
</form>