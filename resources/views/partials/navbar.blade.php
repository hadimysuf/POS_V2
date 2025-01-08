<nav class="navbar navbar-expand-lg" id="top_nav">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <button class="btn d-md-none d-block me-2 toggle-sidebar">
                <i class="fa-solid fa-bars text-white"></i>
            </button>
            <a class="navbar-brand" href="#">
                <h4 class="mb-0"><i>Point Of Sales</i></h4>
            </a>
        </div>
        <div class="nav-right">
            <div class="nav-item dropdown profile-dropdown">
                <a class="nav-link dropdown-toggle" href="#"
                    id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle fa-lg"></i>
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
                    <li><hr class="dropdown-divider"></li>
                    @if (session('username'))
                        <li>
                            <a class="dropdown-item text-center" href="{{ route('logout') }}">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    @else
                        <li>
                            <span class="dropdown-item text-center text-muted">Not logged in</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>