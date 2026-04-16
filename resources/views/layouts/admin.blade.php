<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- 🔥 PENTING -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6f8;
            font-size: 15px;
        }

        /* SIDEBAR */
        .sidebar-link {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px;
            border-radius: 8px;
            font-size: 15px;
        }

        .sidebar-link:hover {
            background: rgba(255,255,255,0.1);
        }

        .active-menu {
            background: #0d6efd;
        }

        /* DESKTOP SIDEBAR */
        .sidebar-desktop {
            width: 240px;
            min-height: 100vh;
        }

        /* CONTENT */
        .content-area {
            padding: 15px;
        }

        /* 🔥 MOBILE FIX (INI YANG BIKIN GA PERLU ZOOM) */
        @media (max-width: 768px) {

            body {
                font-size: 16px;
            }

            .content-area {
                padding: 10px !important;
            }

            /* navbar */
            .navbar {
                padding: 10px 12px;
            }

            /* sidebar link lebih besar */
            .sidebar-link {
                padding: 14px;
                font-size: 16px;
            }

            /* form global */
            input, select, textarea {
                height: 55px !important;
                font-size: 18px !important;
            }

            button {
                height: 55px !important;
                font-size: 18px !important;
            }

            /* card biar full */
            .card {
                border-radius: 0 !important;
            }
        }
    </style>
</head>
<body>

<!-- 🔥 TOP BAR MOBILE -->
<nav class="navbar navbar-dark bg-dark d-md-none">
    <div class="container-fluid">

        <button class="btn btn-outline-light" 
                data-bs-toggle="offcanvas" 
                data-bs-target="#sidebarMobile">
            ☰
        </button>

        <span class="text-white fw-bold">Admin</span>
    </div>
</nav>

<div class="d-flex">

    <!-- DESKTOP SIDEBAR -->
    <div class="bg-dark text-white p-3 sidebar-desktop d-none d-md-block">

        <h5 class="text-center mb-4">Admin Panel</h5>

        @include('partials.sidebar')

    </div>

    <!-- CONTENT -->
    <div class="content-area flex-grow-1">

        @yield('content')

    </div>

</div>

<!-- 🔥 SIDEBAR MOBILE -->
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

{{-- 🔥 SLOT SCRIPT --}}
@yield('script')

</body>
</html>