<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info bg-light elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link bg-info">
        <img src="{{url('logo/jiwalu-logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle border border-white" style="opacity: .8">
        <span class="brand-text text-white font-weight-bold">Jiwalu Carwash</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{url('../dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth()->user()->name }} <i class="@if (Auth()->user()->role->role_name == 'owner') fas fa-check-circle @endif"></i></a>
                <a href="/logout" class="btn btn-sm btn-warning"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div> --}}
        <!-- database->controller->view -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="/" class="nav-link {{ request()->segment(1) == '' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-box"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/transaction" class="nav-link {{ request()->segment(1) == 'transaction' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-exchange-alt"></i>
                            <p>
                                Transaksi
                            </p>
                        </a>
                    </li>
                    @if(Auth()->user()->role->role_name == "owner" || Auth()->user()->role->role_name == "supervisor")
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Karyawan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/employee" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Karyawan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/employee/commission" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Komisi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/employee/attendance" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Absensi</p>
                                </a>
                            </li>
                        </ul>
                    </li><li class="nav-item">
                        <a href="#" class="nav-link {{ (request()->segment(1) == 'product' || request()->segment(1) == 'inventory') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>
                                Inventori & Produk
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/shopping" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Perbelanjaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/inventory" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Inventory</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/supplier" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Supplier</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/product_category" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori Produk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/product" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Produk</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link  {{ request()->segment(1) == 'product' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>
                                Produk
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                        </ul>
                    </li> --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link  {{ request()->segment(1) == 'promo' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-percentage"></i>
                            <p>
                                Promo
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/promo/product" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Diskon Produk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/product" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Produk</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Laporan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/report/summary" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ringkasan Laporan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/report/product/all" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Semua Penjualan Produk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/report/daily" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Laporan Harian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/report/monthly" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Laporan Bulanan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-wallet"></i>
                            <p>
                                Keuangan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/outcome" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>pengeluaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/outcome" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>pemasukan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-tie"></i>
                            <p>
                                Pelanggan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/customer" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Pelanggan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Account Management
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/account" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Account</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>
                                Invoice
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/invoice" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Invoice</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    
                    <li class="nav-item">
                        <a href="/config" class="nav-link {{ request()->segment(1) == 'config' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Pengaturan
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
