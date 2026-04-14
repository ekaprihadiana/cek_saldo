<style>
    .sidebar-container {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    
    .sidebar-link {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        text-decoration: none;
        color: #f5f0f0;
        border-radius: 8px;
        transition: 0.3s;
    }

    .active-menu {
        background-color: #007bff;
        color: white !important;
    }

    /* Responsive: Di layar HP (max 768px), menu jadi berjajar horizontal */
    @media (max-width: 768px) {
        .sidebar-container {
            flex-direction: row;
            overflow-x: auto;
            white-space: nowrap;
            padding: 10px;
            background: #f8f9fa;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-top: 1px solid #ddd;
        }
        
        .sidebar-link {
            flex: 1;
            justify-content: center;
            font-size: 12px;
            flex-direction: column;
        }
        
        hr { display: none; } /* Sembunyikan garis pembatas di mobile */
    }
</style>

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