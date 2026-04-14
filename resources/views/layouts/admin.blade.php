<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6f8;
        }

        .sidebar-link {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 6px;
        }

        .sidebar-link:hover {
            background: rgba(255,255,255,0.1);
        }

        .active-menu {
            background: #0d6efd;
        }

        /* desktop sidebar */
        .sidebar-desktop {
            width: 250px;
            min-height: 100vh;
        }
    </style>
</head>
<body>

<!-- TOP BAR (mobile menu button) -->
<nav class="navbar navbar-dark bg-dark d-md-none">
    <div class="container-fluid">
        <button class="btn btn-outline-light" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile">
            ☰ Menu
        </button>
        <span class="text-white">Admin Panel</span>
    </div>
</nav>

<div class="d-flex">

    <!-- SIDEBAR DESKTOP -->
    <div class="bg-dark text-white p-3 sidebar-desktop d-none d-md-block">

        <h4 class="text-center mb-4">Admin Panel</h4>

        @include('partials.sidebar')

    </div>

    <!-- CONTENT -->
    <div class="p-4 w-100">

        @yield('content')

    </div>

</div>

<!-- SIDEBAR MOBILE (OFFCANVAS) -->
<div class="offcanvas offcanvas-start bg-dark text-white" id="sidebarMobile">

    <div class="offcanvas-header">
        <h5 class="text-white">Menu</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">

        @include('partials.sidebar')

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>