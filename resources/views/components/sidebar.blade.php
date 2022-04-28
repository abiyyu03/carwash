<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-maroon bg-light elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link bg-maroon">
        <img src="{{url('logo/jiwalu-logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle border border-white" style="opacity: .8">
        <span class="brand-text text-white font-weight-bold">Jiwalu Carwash</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{url('../dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth()->user()->name }}</a>
                <a href="/logout" class="btn btn-sm btn-warning"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
        
        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar bg-light" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}
        
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="/" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/transaction" class="nav-link">
                            <i class="nav-icon fas fa-exchange-alt"></i>
                            <p>
                                Transaksi
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>
                                Produk
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/product_category" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Kategori Produk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/product" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Semua Produk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/charts/chartjs.html" class="nav-link">
                                    <i class="far fa-dot nav-icon"></i>
                                    <p>Cuci Mobil</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/charts/flot.html" class="nav-link">
                                    <i class="far fa-dot nav-icon"></i>
                                    <p>Cuci Motor</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/charts/inline.html" class="nav-link">
                                    <i class="far fa-dot nav-icon"></i>
                                    <p>Salon</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/charts/uplot.html" class="nav-link">
                                    <i class="far fa-dot nav-icon"></i>
                                    <p>Aksesoris</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/charts/uplot.html" class="nav-link">
                                    <i class="far fa-dot nav-icon"></i>
                                    <p>Makanan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/charts/uplot.html" class="nav-link">
                                    <i class="far fa-dot nav-icon"></i>
                                    <p>Minuman</p>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="pages/layout/boxed.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Produk</p>
                                    <i class="right fas fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    
                                </ul>
                            </li> -->
                            <li class="nav-item">
                                <a href="/vehicle_type" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tipe Kendaraan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
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
                                <a href="pages/forms/advanced.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Komisi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/forms/advanced.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Absensi</p>
                                </a>
                            </li>
                        </ul>
                    </li><li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-warehouse"></i>
                            <p>
                                Inventori
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/supplier" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Supplier</p>
                                </a>
                                <a href="/inventory" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Daftar Inventory</p>
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
                            <li class="nav-item">
                                <!-- <a href="pages/tables/jsgrid.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tipe Kendaraan</p>
                                </a> -->
                                <!-- <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="pages/tables/simple.html" class="nav-link">
                                            <p>Jenis Kendaraan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/tables/data.html" class="nav-link">
                                            <p>DataTables</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/tables/jsgrid.html" class="nav-link">
                                            <p>jsGrid</p>
                                        </a>
                                    </li>
                                </ul> -->
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
                                <a href="pages/tables/simple.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Account</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/tables/data.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Role Manager</p>
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
                                <a href="pages/tables/simple.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Account</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/tables/data.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Role Manager</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    