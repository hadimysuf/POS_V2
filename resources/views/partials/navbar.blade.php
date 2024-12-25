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
