<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Point of Sales</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    {{-- <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @stack('styles') --}}
    <style>
        /* Variables */
        :root {
            --primary-gradient: linear-gradient(45deg, #00c6fb, #005bea);
            --sidebar-bg: linear-gradient(145deg, #314b66, #2a3744);
            --text-light: rgba(255, 255, 255, 0.7);
            --hover-color: #00c6fb;
        }

        /* Sidebar Styles */
        body {
            background: linear-gradient(135deg, #1a1f25 0%, #2c3e50 100%);
            color: #e0e0e0;
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
        }

        .sidebar {
            min-height: 100vh;
            width: 250px;
            transition: all 0.3s;
            background: var(--sidebar-bg);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar ul li {
            padding: 10px 0;
        }

        .sidebar ul li a {
            color: var(--text-light);
            font-size: 16px;
            padding: 12px 15px;
            display: block;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background: rgba(255, 255, 255, 0.1);
            color: var(--hover-color);
            transform: translateX(5px);
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        /* Main Container */
        .main-container {
            display: flex;
            background: linear-gradient(135deg, #1a1c2a 0%, #2d2b3d 100%);
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        /* Navbar Styles */
        #top_nav {
            background: rgba(31, 29, 43, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand {
            color: #ffffff;
        }

        .gradient-text {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-link {
            color: var(--text-light) !important;
        }

        .nav-link:hover {
            color: var(--hover-color) !important;
        }

        /* Dropdown Styles */
        .dropdown-menu {
            background: linear-gradient(145deg, #314b66, #2a3744);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        }

        .dropdown-item {
            color: var(--text-light);
        }

        .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--hover-color);
        }

        .dropdown-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Responsive */
        @media(max-width: 767px) {
            .sidebar {
                width: 70px;
                min-width: 70px;
            }

            .sidebar .header-box span,
            .sidebar ul li a span {
                display: none;
            }

            .content {
                width: calc(100% - 70px);
            }
        }

        /* Content Area */
        .container {
            color: var(--text-light);
        }

        /* Cards */
        .card {
            background: var(--sidebar-bg);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 12px 40px rgba(0, 198, 251, 0.15);
        }
    </style>
</head>
<body>
    <div class="main-container">
        {{-- @include('partials.sidebar') --}}
        <div class="sidebar bg-dark text-white" id="side_nav">
            <div class="header-box text-center py-3">
                <h1 class="fs-4">
                    <span class="text-dark rounded shadow px-2 me-1" id="orange">POS</span>
                    <span class="text-white"><i>Menu Admin</i></span>
                </h1>
            </div>
            <ul class="list-unstyled px-3">
                <li><a class="text-decoration-none {{ Request::is('dashboard*') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-house"></i> Dashboard</a></li>
                <li><a class="text-decoration-none {{ Request::is('users*') ? 'active' : '' }}"
                        href="{{ route('users.index') }}"><i class="fa-solid fa-users"></i> Users</a></li>
                <li><a class="text-decoration-none {{ Request::is('products*') ? 'active' : '' }}" href=""><i
                            class="fa-solid fa-list-check"></i> Produk</a></li>
                <li><a class="text-decoration-none {{ Request::is('transactions*') ? 'active' : '' }}"
                        href="{{ route('history.index') }}"><i class="fa-solid fa-box"></i> Transaksi</a></li>
            </ul>
        </div>
        <div class="content">
            {{-- @include('partials.navbar') --}}
            <nav class="navbar navbar-expand-lg" id="top_nav">
                <div class="container-fluid">
                    <!-- Sidebar Toggle and Brand -->
                    <div class="d-flex align-items-center">
                        <button class="btn d-md-none d-block me-2 toggle-sidebar">
                            <i class="fa-solid fa-bars-staggered text-white"></i>
                        </button>
                        <a class="navbar-brand gradient-text fw-bold" href="#">
                            <h4 class="mb-0"><i>Point Of Sales</i></h4>
                        </a>
                    </div>
                    <!-- Profile Dropdown -->
                    <div class="nav-right d-flex align-items-center">
                        <div class="nav-item dropdown profile-dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user me-2"></i>Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cog me-2"></i>Settings
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <!-- Logout -->
                                @if (session('username'))
                                    <li>
                                        <a class="dropdown-item fw-bold text-center" href="{{ route('logout') }}">
                                            Logout
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <span class="dropdown-item text-center text-muted">Kosong</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="container mt-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    @stack('scripts')
</body>

</html>
