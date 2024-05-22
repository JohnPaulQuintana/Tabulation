<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tabulation</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />

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
            background: #343a40;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #2b302e;
            cursor: pointer;
        }

        .hidden {
            display: none;
        }

        .error {
            color: red;
        }

        /* Modal container */
        .loginModal {

            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal content */
        .loginModal-content {
            background-color: #fefefe;
            margin: 10% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Could be more or less, depending on screen size */
            max-width: 600px;
            /* Maximum width */
            border-radius: 8px;
            /* Rounded corners */
            color: #061f1d;

        }

        .loginModal-content .controls {
            display: flex;
            justify-content: space-between;
        }

        .loginModal-content .controls .close {
            cursor: pointer;
        }

        .loginModal-content form {
            padding: 10px;
            background-color: #1a2e35;
            border-radius: 5px;
        }

        .loginModal-content form .input-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            /* color: #1cbbb4; */
        }

        .loginModal-content form .input-group label {
            color: white;
        }

        .loginModal-content form .input-group input,
        .loginModal-content form .input-group button {
            padding: 10px;
            border-radius: 8px;
            border-color: none;
            border: 0;
        }

        .loginModal-content form .input-group button {
            background: #1cbbb4;
            border: 0;
            color: white;
        }
    </style>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body class="">
    {{-- <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

        </div> --}}
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand" href="index.html">
                        <img src="{{ asset('images/ama.png') }}" alt="" />
                        <span>
                            {{ config('app.name', 'Laravel') }}
                        </span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  ">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#category"> Category </a>
                            </li>
                        </ul>
                        <div class="user_option">
                            <a href="#" id="authenticate">
                                <span>
                                    Login
                                </span>
                            </a>

                        </div>
                    </div>
                    <div>
                        <div class="custom_menu-btn ">
                            <button>
                                <span class=" s-1">

                                </span>
                                <span class="s-2">

                                </span>
                                <span class="s-3">

                                </span>
                            </button>
                        </div>
                    </div>

                </nav>
            </div>
        </header>
        <!-- end header section -->

        <!-- slider section -->
        <section class="slider_section ">
            <div class="carousel_btn-container">
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">00</li>
                    @foreach ($events as $key => $item)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key+1 }}">
                            {{ $key + 1 }}</li>
                    @endforeach
                    {{-- <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">01</li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1">02</li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2">03</li> --}}
                </ol>
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-5 offset-md-1">
                                    <div class="detail-box">
                                        <h1>
                                            Welcome to AMA Tabulation System
                                        </h1>
                                        <p>
                                            Our app is designed to streamline your tabulation process, offering you accurate and efficient results. Whether you're managing data, calculating scores, or organizing information, we've got you covered.
                                        </p>
                                        {{-- <div class="btn-box">
                                            <a href="" class="btn-1">
                                                Details
                                            </a>
                                            <a href="" class="btn-2">
                                                Candidates
                                            </a>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="offset-md-1 col-md-4 img-container">
                                    <div class="img-box">
                                        <img src="{{ asset('images/ama.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($events as $key => $item)
                        @if ($item->type !== 'System Message')
                            <div class="carousel-item">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-5 offset-md-1">
                                            <div class="detail-box">
                                                <h1>
                                                    {{ $item->name }}
                                                </h1>
                                                <p>
                                                    {{ $item->details }}
                                                </p>
                                               
                                                    <p style="font-size: 22px; font-weight:700;">
                                                        {{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }} 
                                                        {{-- {{ $item->created_at->format('F j, Y') }} --}}
                                                    </p>
                                                    <div class="btn-box">
                                                        <a href="" class="btn-1">
                                                            Details
                                                        </a>
                                                        <a href="" class="btn-2">
                                                            Candidates
                                                        </a>
                                                    </div>
                                               
                                            </div>
                                        </div>
                                        <div class="offset-md-1 col-md-4 img-container">
                                            <div class="img-box">
                                                <img src="{{ asset('storage').'/'.$item->image }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>


            </div>

        </section>
        <!-- end slider section -->


    </div>



    <div style="padding: 2px"></div>



    <!-- category section -->

    <section id="category" class="category_section layout_padding">
        <div class="container">
            <div class="heading_container">
                <h2>
                    Category
                </h2>
            </div>
            <div class="category_container">
                @foreach ($events as $item)
                    <div class="box">
                        <div class="img-box">
                            <img src="images/c1.png" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $item->type }}
                            </h5>
                        </div>
                    </div>
                @endforeach
                <div class="box">
                    <div class="img-box">
                        <img src="images/c1.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Sports
                        </h5>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="images/c2.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Sports
                        </h5>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="images/c3.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Sports
                        </h5>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="images/c4.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Sports
                        </h5>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="images/c5.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Sports
                        </h5>
                    </div>
                </div>
                <div class="box">
                    <div class="img-box">
                        <img src="images/c6.png" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            Sports
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- end category section -->

    @if (isset($online))
     @include('popup.judge',['event'=>$online])
     @else
     @include('popup.login')
    @endif
   
    
    <!-- footer section -->
    <footer class="container-fluid footer_section">
        <div class="container">
            <p>
                &copy; <span id="displayDate"></span> All Rights Reserved By
                <a href="#">Tabulation</a>
            </p>
        </div>
    </footer>
    <!-- end  footer section -->


    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
