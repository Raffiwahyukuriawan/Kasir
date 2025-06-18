        <!-- BEGIN: Top Menu -->
        <nav class="top-nav">
            <ul>
                @if (\Auth::user()->role == 'manager')
                    <li class="">
                        <a href="{{ route('manager') }}"
                            class="top-menu top-menu--{{ request()->is('dashboard/manager') ? 'active' : '' }}">
                            <div class="top-menu__icon"> <i data-feather="home"></i> </div>
                            <div class="top-menu__title"> Dashboard </div>
                        </a>
                    </li>
                    <li>
                        <a href="/keuangan/manager"
                            class="top-menu top-menu--{{ Request::is('keuangan/manager') ? 'active' : '' }}">
                            <div class="top-menu__icon"> <i data-feather="credit-card"></i> </div>
                            <div class="top-menu__title"> Keuangan </div>
                        </a>
                    </li>
                @endif

                @if (\Auth::user()->role == 'admin')
                    <li class="">
                        <a href="/" class="top-menu top-menu--{{ request()->is('/') ? 'active' : '' }}">
                            <div class="top-menu__icon"> <i data-feather="home"></i> </div>
                            <div class="top-menu__title"> Dashboard </div>
                        </a>
                    </li>
                @endif

                @if (\Auth::user()->role == 'kasir')
                    <li class="">
                        <a href="{{ route('dashboard_kasir') }}"
                            class="top-menu top-menu--{{ request()->is('dashboard_kasir') ? 'active' : '' }}">
                            <div class="top-menu__icon"> <i data-feather="home"></i> </div>
                            <div class="top-menu__title"> Dashboard </div>
                        </a>
                    </li>
                @endif

                @if (\Auth::user()->role == 'kasir')
                    <li>
                        <a href="{{ route('transaksi.kasir') }}"
                            class="top-menu top-menu--{{ Request::is('transaksi*', 'penjualan', 'invoice*') ? 'active' : '' }}">
                            <div class="top-menu__icon"> <i data-feather="shopping-cart"></i> </div>
                            <div class="top-menu__title"> Transaksi </div>
                        </a>
                    </li>
                @endif

                @if (\Auth::user()->role == 'admin')
                    <li>
                        <a href="{{ route('transaksi.admin') }}"
                            class="top-menu top-menu--{{ Request::is('transaksi/admin', 'invoice*') ? 'active' : '' }}">
                            <div class="top-menu__icon"> <i data-feather="shopping-cart"></i> </div>
                            <div class="top-menu__title"> Transaksi </div>
                        </a>
                    </li>
                @endif

                @if (\Auth::user()->role == 'admin')
                    <li>
                        <a href="/keuangan"
                            class="top-menu top-menu--{{ Request::is('keuangan', 'admin/penjualan', 'admin/penjualan/laba_rugi') ? 'active' : '' }}">
                            <div class="top-menu__icon"> <i data-feather="credit-card"></i> </div>
                            <div class="top-menu__title"> Keuangan </div>
                        </a>
                    </li>
                @endif

                @if (\Auth::user()->role == 'admin')
                    <li class="">
                        <a href="{{ route('produk') }}"
                            class="top-menu top-menu--{{ Request::is('produk', 'produk_kategori') ? 'active' : '' }}">
                            <div class="top-menu__icon"> <i data-feather="box"></i> </div>
                            <div class="top-menu__title"> Produk </div>
                        </a>
                    </li>
                @endif

                @if (\Auth::user()->role == 'admin')
                    <li>
                        <a href="{{ route('kategori') }}"
                            class="top-menu top-menu--{{ Request::is('kategori', 'produk_kategori*') ? 'active' : '' }}">
                            <div class="top-menu__icon"> <i data-feather="grid"></i> </div>
                            <div class="top-menu__title"> Kategori </div>
                        </a>
                    </li>
                @endif

                @if (\Auth::user()->role == 'admin')
                    <li class="">
                        <a href="{{ route('supplier') }}"
                            class="top-menu top-menu--{{ Request::is('supplier') ? 'active' : '' }}">
                            <div class="top-menu__icon"> <i data-feather="user"></i> </div>
                            <div class="top-menu__title"> Supplier </div>
                        </a>
                    </li>
                @endif

                @if (\Auth::user()->role == 'admin')
                    <li class="">
                        <a href="{{ route('pengguna') }}"
                            class="top-menu top-menu--{{ Request::is('pengguna') ? 'active' : '' }}">
                            <div class="top-menu__icon"> <i data-feather="user"></i> </div>
                            <div class="top-menu__title"> Pengguna </div>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- END: Top Menu -->
