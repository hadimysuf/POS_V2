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
