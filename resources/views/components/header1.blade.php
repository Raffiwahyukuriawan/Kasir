        <!-- BEGIN: Top Bar -->
        @props(['title'])
        <div class="border-b border-theme-24 -mt-10 md:-mt-5 -mx-3 sm:-mx-8 px-3 sm:px-8 pt-3 md:pt-0 mb-10">
            <div class="top-bar-boxed flex items-center">
                <!-- BEGIN: Logo -->
                <a href="" class="-intro-x hidden md:flex">
                    <img class="h-20 w-auto mr-2" src="{{ asset('assets/logo/'. $konfigurasi['logo']) }}" alt="Logo Perusahaan">
                    <span class="text-white text-lg mt-8"> {{ $konfigurasi['nama_toko'] }}<span class="font-medium"></span> </span>
                </a>
                <!-- END: Logo -->
                <!-- BEGIN: Breadcrumb -->
                <div class="-intro-x breadcrumb breadcrumb--light mr-auto"> <a href=""
                        class="">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a
                        href="" class="breadcrumb--active">
                        {{ ucfirst(request()->segment(1) ?? 'Dashboard') }}
                    </a> </div>
                <!-- END: Breadcrumb -->
                <!-- BEGIN: Search -->
                <div class="intro-x relative mr-3 sm:mr-6">
                    <div class="search hidden sm:block">
                        <input type="text" class="search__input input placeholder-theme-13" placeholder="Search...">
                        <i data-feather="search" class="search__icon"></i>
                    </div>
                    <a class="notification notification--light sm:hidden" href=""> <i data-feather="search"
                            class="notification__icon"></i> </a>
                    <div class="search-result">
                        @if (\Auth::user()->role == 'admin')
                            <div class="search-result__content">
                                <div class="search-result__content__title">Pages</div>
                                <div class="mb-5">
                                    <a href="/" class="flex items-center">
                                        <div
                                            class="w-8 h-8 bg-theme-18 text-theme-9 flex items-center justify-center rounded-full">
                                            <i class="w-4 h-4" data-feather="inbox"></i>
                                        </div>
                                        <div class="ml-3">Dashboard</div>
                                    </a>
                                    <a href="{{ route('transaksi.admin') }}" class="flex items-center mt-2">
                                        <div
                                            class="w-8 h-8 bg-theme-17 text-theme-11 flex items-center justify-center rounded-full">
                                            <i class="w-4 h-4" data-feather="users"></i>
                                        </div>
                                        <div class="ml-3">Transaksi</div>
                                    </a>
                                    <a href="/keuangan" class="flex items-center mt-2">
                                        <div
                                            class="w-8 h-8 bg-theme-14 text-theme-10 flex items-center justify-center rounded-full">
                                            <i class="w-4 h-4" data-feather="credit-card"></i>
                                        </div>
                                        <div class="ml-3">Kauangan</div>
                                    </a>
                                    <a href="/produk" class="flex items-center mt-2">
                                        <div
                                            class="w-8 h-8 bg-theme-14 text-theme-10 flex items-center justify-center rounded-full">
                                            <i class="w-4 h-4" data-feather="credit-card"></i>
                                        </div>
                                        <div class="ml-3">Produk</div>
                                    </a>
                                    <a href="/kategori" class="flex items-center mt-2">
                                        <div
                                            class="w-8 h-8 bg-theme-14 text-theme-10 flex items-center justify-center rounded-full">
                                            <i class="w-4 h-4" data-feather="credit-card"></i>
                                        </div>
                                        <div class="ml-3">Kategori</div>
                                    </a>
                                    <a href="/supplier" class="flex items-center mt-2">
                                        <div
                                            class="w-8 h-8 bg-theme-14 text-theme-10 flex items-center justify-center rounded-full">
                                            <i class="w-4 h-4" data-feather="credit-card"></i>
                                        </div>
                                        <div class="ml-3">Supplier</div>
                                    </a>
                                    <a href="/pengguna" class="flex items-center mt-2">
                                        <div
                                            class="w-8 h-8 bg-theme-14 text-theme-10 flex items-center justify-center rounded-full">
                                            <i class="w-4 h-4" data-feather="credit-card"></i>
                                        </div>
                                        <div class="ml-3">Pengguna</div>
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if (\Auth::user()->role == 'kasir')
                            <div class="search-result__content">
                                <div class="search-result__content__title">Pages</div>
                                <div class="mb-5">
                                    <a href="/dashboard_kasir" class="flex items-center">
                                        <div
                                            class="w-8 h-8 bg-theme-18 text-theme-9 flex items-center justify-center rounded-full">
                                            <i class="w-4 h-4" data-feather="inbox"></i>
                                        </div>
                                        <div class="ml-3">Dashboard</div>
                                    </a>
                                    <a href="/transaksi" class="flex items-center mt-2">
                                        <div
                                            class="w-8 h-8 bg-theme-17 text-theme-11 flex items-center justify-center rounded-full">
                                            <i class="w-4 h-4" data-feather="users"></i>
                                        </div>
                                        <div class="ml-3">Transaksi</div>
                                    </a>
                                    <a href="/penjualan" class="flex items-center mt-2">
                                        <div
                                            class="w-8 h-8 bg-theme-14 text-theme-10 flex items-center justify-center rounded-full">
                                            <i class="w-4 h-4" data-feather="credit-card"></i>
                                        </div>
                                        <div class="ml-3">Penjualan</div>
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if (\Auth::user()->role == 'manager')
                        <div class="search-result__content">
                            <div class="search-result__content__title">Pages</div>
                            <div class="mb-5">
                                <a href="/dashboard/manager" class="flex items-center">
                                    <div
                                        class="w-8 h-8 bg-theme-18 text-theme-9 flex items-center justify-center rounded-full">
                                        <i class="w-4 h-4" data-feather="inbox"></i>
                                    </div>
                                    <div class="ml-3">Dashboard</div>
                                </a>

                                <a href="/keuangan/manager" class="flex items-center mt-2">
                                    <div
                                        class="w-8 h-8 bg-theme-14 text-theme-10 flex items-center justify-center rounded-full">
                                        <i class="w-4 h-4" data-feather="credit-card"></i>
                                    </div>
                                    <div class="ml-3">Keuangan</div>
                                </a>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
                <!-- END: Search -->
                <!-- BEGIN: Notifications -->
                <div class="intro-x dropdown relative mr-4 sm:mr-6">
                    <div class="notification-content dropdown-box mt-8 absolute top-0 right-0 z-10 -mr-10 sm:mr-0">
                        <div class="notification-content__box dropdown-box__content box">
                            <div class="notification-content__title">Notifications</div>
                            <div class="cursor-pointer relative flex items-center ">
                                <div class="w-12 h-12 flex-none image-fit mr-1">
                                    <img alt="Midone Tailwind HTML Admin Template" class="rounded-full"
                                        src="/dist/images/profile-11.jpg">
                                    <div
                                        class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white">
                                    </div>
                                </div>
                                <div class="ml-2 overflow-hidden">
                                    <div class="flex items-center">
                                        <a href="javascript:;" class="font-medium truncate mr-5">Denzel Washington</a>
                                        <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">01:10 PM</div>
                                    </div>
                                    <div class="w-full truncate text-gray-600">Lorem Ipsum is simply dummy text of the
                                        printing and typesetting industry. Lorem Ipsum has been the industry&#039;s
                                        standard dummy text ever since the 1500</div>
                                </div>
                            </div>
                            <div class="cursor-pointer relative flex items-center mt-5">
                                <div class="w-12 h-12 flex-none image-fit mr-1">
                                    <img alt="Midone Tailwind HTML Admin Template" class="rounded-full"
                                        src="dist/images/profile-7.jpg">
                                    <div
                                        class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white">
                                    </div>
                                </div>
                                <div class="ml-2 overflow-hidden">
                                    <div class="flex items-center">
                                        <a href="javascript:;" class="font-medium truncate mr-5">Robert De Niro</a>
                                        <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">01:10 PM</div>
                                    </div>
                                    <div class="w-full truncate text-gray-600">Lorem Ipsum is simply dummy text of the
                                        printing and typesetting industry. Lorem Ipsum has been the industry&#039;s
                                        standard dummy text ever since the 1500</div>
                                </div>
                            </div>
                            <div class="cursor-pointer relative flex items-center mt-5">
                                <div class="w-12 h-12 flex-none image-fit mr-1">
                                    <img alt="Midone Tailwind HTML Admin Template" class="rounded-full"
                                        src="dist/images/profile-3.jpg">
                                    <div
                                        class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white">
                                    </div>
                                </div>
                                <div class="ml-2 overflow-hidden">
                                    <div class="flex items-center">
                                        <a href="javascript:;" class="font-medium truncate mr-5">John Travolta</a>
                                        <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">01:10 PM</div>
                                    </div>
                                    <div class="w-full truncate text-gray-600">It is a long established fact that a
                                        reader will be distracted by the readable content of a page when looking at its
                                        layout. The point of using Lorem </div>
                                </div>
                            </div>
                            <div class="cursor-pointer relative flex items-center mt-5">
                                <div class="w-12 h-12 flex-none image-fit mr-1">
                                    <img alt="Midone Tailwind HTML Admin Template" class="rounded-full"
                                        src="dist/images/profile-1.jpg">
                                    <div
                                        class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white">
                                    </div>
                                </div>
                                <div class="ml-2 overflow-hidden">
                                    <div class="flex items-center">
                                        <a href="javascript:;" class="font-medium truncate mr-5">Tom Cruise</a>
                                        <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">01:10 PM</div>
                                    </div>
                                    <div class="w-full truncate text-gray-600">Contrary to popular belief, Lorem Ipsum
                                        is not simply random text. It has roots in a piece of classical Latin literature
                                        from 45 BC, making it over 20</div>
                                </div>
                            </div>
                            <div class="cursor-pointer relative flex items-center mt-5">
                                <div class="w-12 h-12 flex-none image-fit mr-1">
                                    <img alt="Midone Tailwind HTML Admin Template" class="rounded-full"
                                        src="dist/images/profile-3.jpg">
                                    <div
                                        class="w-3 h-3 bg-theme-9 absolute right-0 bottom-0 rounded-full border-2 border-white">
                                    </div>
                                </div>
                                <div class="ml-2 overflow-hidden">
                                    <div class="flex items-center">
                                        <a href="javascript:;" class="font-medium truncate mr-5">Al Pacino</a>
                                        <div class="text-xs text-gray-500 ml-auto whitespace-no-wrap">05:09 AM</div>
                                    </div>
                                    <div class="w-full truncate text-gray-600">There are many variations of passages of
                                        Lorem Ipsum available, but the majority have suffered alteration in some form,
                                        by injected humour, or randomi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Notifications -->
                <!-- BEGIN: Account Menu -->
                <div class="intro-x dropdown w-8 h-8 relative">
                    <div
                        class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110">
                        <img alt="Midone Tailwind HTML Admin Template" src="/dist/images/profile-9.jpg">
                    </div>
                    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                        <div class="dropdown-box__content box bg-theme-38 text-white">
                            <div class="p-4 border-b border-theme-40">
                                <div class="font-medium">{{ Auth::user()->nama }}</div>
                                <div class="text-xs text-theme-41">{{ Auth::user()->role }}</div>
                            </div>
                            <div class="p-2 border-t border-theme-40">
                                @if (\Auth::user()->role == 'admin')
                                    <a href="{{ route('konfigurasi') }}"
                                        class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                        <i data-feather="settings" class="w-4 h-4 mr-2"></i> Konfigurasi </a>
                                @endif

                                {{-- <div class="p-2 border-t border-theme-40"> --}}
                                <a href="{{ route('logout') }}"
                                    class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md ml-1">
                                    <i data-feather="log-out" class="w-4 h-4 mr-2"></i> Logout </a>
                                <div class="p-2 border-t border-theme-40">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Account Menu -->
            </div>
        </div>
        <!-- END: Top Bar -->
