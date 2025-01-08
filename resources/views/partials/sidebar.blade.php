<div class="sidebar" id="side_nav">
    <div class="header-box">
        <h1>
            <span id="orange">POS</span>
            <span class="orange"><i>Menu Admin</i></span>
        </h1>
        
    </div>
    <ul class="list-unstyled">
        <li>
            <a class="text-decoration-none {{ Request::is('admin/dashboard*') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a class="text-decoration-none {{ Request::is('admin/users*') ? 'active' : '' }}"
                href="{{ route('users.index') }}">
                <i class="fa-solid fa-users"></i>
                <span>Users</span>
            </a>
        </li>
        <li>
            <a class="text-decoration-none {{ Request::is('admin/produk*') ? 'active' : '' }}"
                href="{{ route('produk.index') }}">
                <i class="fa-solid fa-list-check"></i>
                <span>Produk</span>
            </a>
        </li>
        <li>
            <a class="text-decoration-none {{ Request::is('admin/history*') ? 'active' : '' }}"
                href="{{ route('history.index') }}">
                <i class="fa-solid fa-box"></i>
                <span>Transaksi</span>
            </a>
        </li>
    </ul>
</div>