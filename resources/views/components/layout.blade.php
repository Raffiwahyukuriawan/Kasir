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
    <link href="{{ asset('assets/logo/'.$konfigurasi['logo']) }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>{{ $konfigurasi['nama_toko'] }}</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="/dist/css/app.css" />
    <!-- END: CSS Assets-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
 .report-chart-wrapper {
    width: 100%;
    max-height: 400px;
    overflow-x: auto;
    overflow-y: auto;
    white-space: nowrap; /* Pastikan kontennya tidak terpotong */
}

.report-chart-wrapper canvas {
    min-width: 1200px; /* Lebarkan kanvas agar bisa discroll */
    min-height: 400px;
}

    </style>
</head>
<!-- END: Head -->

<body class="app">
    <!-- BEGIN: Mobile Menu -->
    <x-mobile></x-mobile>
    <!-- END: Mobile Menu -->
    {{-- Header --}}
    <x-header1>
        
    </x-header1>
    {{-- end Header --}}

    {{-- nav-link --}}
    <x-nav_link></x-nav_link>
    {{-- end nav-link --}}

    <!-- BEGIN: Content -->
    {{ $slot }}
    <!-- END: Content -->
    <!-- BEGIN: JS Assets-->
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places"></script>
    <script src="dist/js/app.js"></script>
    <!-- END: JS Assets-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    @push('scripts')
        <script>
            document.getElementById('search-input').addEventListener('input', function() {
                const keyword = this.value;

                fetch(`{{ route('users.search') }}?keyword=${encodeURIComponent(keyword)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('user-table').innerHTML = html;
                    })
                    .catch(error => console.error('Error:', error));
            });
        </script>
    @endpush


</body>

</html>
