<!DOCTYPE html>
<!--
Template Name: Midone - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>Login - Midone</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="dist/css/app.css" />
    <!-- END: CSS Assets-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- END: Head -->

<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Midone Tailwind HTML Admin Template" class="h-20 w-auto" src="{{ asset('assets/logo/'.$konfigurasi['logo']) }}">
                    <span class="text-white text-lg ml-3"> {{ $konfigurasi['nama_toko'] }} </span>
                </a>
                <div class="my-auto">
                    <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16"
                        src="dist/images/illustration.svg">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        Masuk dan kelola 
                        <br>
                        transaksi dengan mudah
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white">Beberapa klik lagi untuk masuk ke akun kasir Anda</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div
                    class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Sign In
                        </h2>
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to
                            your account. Manage all your e-commerce accounts in one place</div>
                        <div class="intro-x mt-8">
                            <input type="email" name="email"
                                class="intro-x login__input input input--lg border border-gray-300 block"
                                placeholder="email">

                            <input type="password" name="password"
                                class="intro-x login__input input input--lg border border-gray-300 block mt-4"
                                placeholder="Password">
                            @error('email')
                                <div
                                    class=" alert-box rounded-md flex items-center px-5 mt-3 py-4 mb-2 bg-gray-200 text-red-600">
                                    <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {{ $message }} <i
                                        data-feather="x" class="w-4 h-4 ml-auto close-alert"></i> </div>
                            @enderror
                        </div>
                        <div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto">
                                <input type="checkbox" class="input border mr-2" id="remember-me" required>
                                <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                            </div>
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit"
                                class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
    <!-- BEGIN: JS Assets-->
    <script src="dist/js/app.js"></script>
    <!-- END: JS Assets-->
    {{-- btn close x --}}
    <script>
        document.querySelectorAll('.close-alert').forEach(button => {
            button.addEventListener('click', function() {
                // Temukan elemen parent dengan kelas "alert-box"
                const alertBox = this.closest('.alert-box');
                if (alertBox) {
                    alertBox.remove(); // Hapus elemen dari DOM
                }
            });
        });
    </script>
    {{-- end btn close x --}}
</body>

</html>
