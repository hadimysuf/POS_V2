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
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="avatar me-2">
                        <img src="" alt="Profile" class="rounded-circle" width="32" height="32">
                    </div>
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
                    <li>
                        @if (session('username'))
                            <li class="nav-item">
                                <a class="nav-link text-center  fw-bold" href="{{ route('logout') }}">Logout</a>
                            </li>
                        @else
                            kosong
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
