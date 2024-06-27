<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    
    <style>
        
        /* Hide the default scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #e46953;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #2b302e;
            cursor: pointer;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    {{-- font awesome --}}
    <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome"
        href="/css/app-wa-462d1fe84b879d730fe2180b0e0354e0.css?vsn=d">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./node_modules/apexcharts/dist/apexcharts.css">
    @yield('links')
    
</head>

<body x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark text-bodydark bg-boxdark-2': darkMode === true }">
    <!-- ===== Preloader Start ===== -->
    @include('partials.loader')
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        @include('partials.sidebar')

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden main">
            <!-- ===== Header Start ===== -->
            @include('partials.header')
            <!-- ===== Header End ===== -->

            <!-- ===== Main Content Start ===== -->
            <main>
                {{ $slot }}
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    @yield('scripts')
    <script>
        $(document).ready(function() {
            

            //dynamic request
            function sendRequest(method, url, data = {}) {
                return new Promise(function(resolve, reject) {
                    // Get the CSRF token from the meta tag
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // Add the CSRF token to the data object
                    data._token = csrfToken;

                    $.ajax({
                        method: method,
                        url: url,
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include CSRF token in the request headers
                        },
                        success: function(response) {
                            resolve(response);
                        },
                        error: function(xhr, status, error) {
                            reject(error);
                        }
                    });
                });
            }

            //popups
            function sweetAlertSuccess(status, message) {
                let timerInterval;
                Swal.fire({
                    title: "Location is now enabled!",
                    html: `<span>${message}</span><span class="block"><b></b></span>`,
                    text: message,
                    icon: status,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");
                        timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                        }, 100);
                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log("I was closed by the timer");
                        window.location.reload();
                    }
                });
            }
        })
    </script>
</body>

</html>
