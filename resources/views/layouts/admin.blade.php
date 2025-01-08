<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Point of Sales</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #3730a3;
            --accent-color: #6366f1;
            --background-dark: #111827;
            --background-light: #1f2937;
            --text-primary: #f3f4f6;
            --text-secondary: #9ca3af;
            --transition-speed: 0.3s;
        }

        body {
            background: var(--background-dark);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
        }

        /* Sidebar Styles */
        /* Sidebar Styles */
        .sidebar {
            background: var(--background-light);
            min-height: 100vh;
            width: 280px;
            position: fixed;
            /* Pastikan sidebar tetap fixed */
            top: 0;
            left: 0;
            transition: var(--transition-speed);
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            /* Pastikan sidebar di atas konten */
        }

        /* Content Area */
        .content {
            margin-left: 280px;
            /* Memberi ruang untuk sidebar yang tetap fixed */
            padding: 1rem;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        /* Responsive Design for Smaller Screens */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1000;
                position: absolute;
                /* Sidebar bisa menggeser saat responsif */
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
                /* Tidak ada margin untuk konten pada mobile */
            }

            /* Toggle Sidebar Button */
            .toggle-sidebar {
                display: block !important;
            }
        }


        .header-box {
            padding: 2rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header-box h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .header-box #orange {
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
        }

        .sidebar ul {
            padding: 1rem 0;
        }

        .sidebar ul li a {
            padding: 0.875rem 1.5rem;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: var(--transition-speed);
            border-left: 3px solid transparent;
        }

        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background: rgba(79, 70, 229, 0.1);
            color: var(--text-primary);
            border-left-color: var(--primary-color);
        }

        .sidebar ul li a i {
            width: 20px;
            text-align: center;
        }

        /* Content Area */
        .content {
            margin-left: 280px;
            padding: 1rem;
            min-height: 100vh;
        }

        /* Navbar Styles */
        #top_nav {
            background: var(--background-light);
            padding: 1rem;
            margin-bottom: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            color: var(--text-primary) !important;
        }

        .navbar-brand h4 {
            font-weight: 600;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Profile Dropdown */
        .profile-dropdown .nav-link {
            color: var(--text-secondary);
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: var(--transition-speed);
        }

        .profile-dropdown .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .dropdown-menu {
            background: var(--background-light);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-radius: 0.75rem;
            padding: 0.5rem;
            min-width: 200px;
        }

        .dropdown-item {
            color: var(--text-secondary);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: var(--transition-speed);
        }

        .dropdown-item:hover {
            background: rgba(79, 70, 229, 0.1);
            color: var(--text-primary);
        }

        .dropdown-divider {
            border-color: rgba(255, 255, 255, 0.1);
            margin: 0.5rem 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1000;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }

            .toggle-sidebar {
                display: block !important;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--background-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-color);
        }
    </style>

</head>

<body>
    <div class="main-container">
        @include('partials.sidebar')
        <div class="content">
            @include('partials.navbar')
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.querySelector('.toggle-sidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.querySelector('.toggle-sidebar');

            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                sidebar.classList.remove('active');
            }
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('top_nav');
            if (window.scrollY > 10) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
    {{-- <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts') --}}
</body>

</html>
