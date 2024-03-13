<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href=" {{ asset('admin/css/font-face.css') }} " rel="stylesheet" media="all">
    {{-- <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all"> --}}
    {{-- <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all"> --}}
    {{-- <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all"> --}}

    <!-- Bootstrap CSS-->
    {{-- <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all"> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Vendor CSS-->
    {{-- <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all"> --}}
    {{-- <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
        media="all"> --}}
    {{-- <link href="{{ asset('admin/vendor/wow/animate.css') }}" rel="stylesheet" media="all"> --}}
    {{-- <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all"> --}}
    {{-- <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all"> --}}
    {{-- <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all"> --}}
    {{-- <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all"> --}}

    <!-- Main CSS-->
    <link href=" {{ asset('admin/css/theme.css') }} " rel="stylesheet" media="all">

    {{-- Font Awasome Link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block ">
            <div class="logo ">
                <a href="#">
                    <img src=" {{ asset('admin/images/icon/logo.png') }} " class="" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list text-black  " style="list-style: none;">

                        <li>
                            <a href="{{ route('category#list') }}" class="text-decoration-none text-black">
                                <i class="fa-solid fa-list"></i>Category</a>
                        </li>

                        <li>
                            <a href="{{ route('product#list') }}" class="text-decoration-none text-black">
                                <i class="fa-solid fa-pizza-slice"></i>Product</a>
                        </li>

                        <li>
                            <a href="{{ route('admin#orderList') }}" class="text-decoration-none text-black">
                                <i class="fa-solid fa-store"></i>Order</a>
                        </li>
                        <li>
                            <a href="{{ route('admin#userMessage') }}" class="text-decoration-none text-black">
                                <i class="fa-regular fa-message"></i>Message</a>
                        </li>

                    </ul>

                    <div class="dropdown mt-2">
                        <a class="text-decoration-none text-black " href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-gear"></i><span class="m-3">Setting</span>
                        </a>


                        <ul class="dropdown-menu my-4">

                            <li>
                                <a class="dropdown-item" href=" {{ route('admin#details') }} "><i
                                        class="fa-solid fa-user me-3"></i>Account</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href=" {{ route('admin#list') }} "><i
                                        class="fa-solid fa-users me-3"></i>Admin List</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href=" {{ route('admin#userList') }} "><i
                                        class="fa-solid fa-users me-3"></i>User List</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('admin#passwordChangePage') }}"><i
                                        class="fa-solid fa-key me-3"></i>Change
                                    Password</a>
                            </li>

                            <li>
                                <form action="{{ route('logout') }}" method="post" class="dropdown-item">
                                    @csrf

                                    <i class="fa-solid fa-power-off"></i>
                                    <button type="submit"><span class=" m-3">Log
                                            Out</span></button>

                                </form>
                            </li>


                        </ul>
                    </div>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop bg-success">
                <div class="section__content section__content--p30 ">
                    <div class="container-fluid ">
                        <div class="header-wrap ">
                            <h4 class="text-white">Admin Category Panel</h4>
                            <div class="header-button">
                                <div class="">
                                    <div class="dropdown ">
                                        <a href="#"
                                            class="btn btn-success rounded-pill text-black border border-white m-1 p-1 "
                                            data-bs-toggle="dropdown" aria-expanded="false">

                                            <div class="">
                                                @if (Auth::user()->image == null)

                                                    @if (Auth::user()->gender == 'male')
                                                        <img
                                                            src="{{ asset('image/profile_male.png') }}"style="width:30px; object-fit:cover; height:30px"class="rounded-circle shadow-sm" />
                                                    @else
                                                        <img
                                                            src="{{ asset('image/profile_female.png') }}"style="width:30px; object-fit:cover; height:30px"class="rounded-circle shadow-sm" />
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                        style="width:30px; object-fit:cover; height:30px"
                                                        class="rounded-circle" />
                                                @endif
                                                <span class="ms-2 me-1 text-white">{{ Auth::user()->name }}</span>
                                            </div>

                                        </a>

                                        <div class="dropdown-menu">
                                            <div class=" dropdown-item">
                                                <div class="image text-center ">
                                                    @if (Auth::user()->image == null)

                                                        @if (Auth::user()->gender == 'male')
                                                            <img src="{{ asset('image/profile_male.png') }}"class="rounded shadow-sm "
                                                                style="height: 150px" />
                                                        @else
                                                            <img
                                                                src="{{ asset('image/profile_female.png') }}"style="height: 150px"class="rounded shadow-sm" />
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                            class="rounded shadow-sm" style="height: 150px" />
                                                    @endif
                                                    <div class="content">
                                                        <h5 class="name my-2">
                                                            {{ Auth::user()->name }}
                                                        </h5>
                                                        <span class="email">{{ Auth::user()->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-item text-center">
                                                <a href="{{ route('admin#details') }}" class="border p-2">
                                                    <button type="submit" class="btn btn-secondary text-white">
                                                        <i class="fa-regular fa-id-badge me-2"></i>Profile
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="dropdown-item ">
                                                <div class="border p-2 bg-light">
                                                    <form action="{{ route('logout') }}"
                                                        class="d-flex justify-content-center "
                                                        method="post"class="my-2">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-secondary text-white col-12">
                                                            <i class="fa-solid fa-power-off me-2"></i>Log Out
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </header>
            <!-- HEADER DESKTOP-->
            @yield('content')
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <!-- Jquery JS-->
    {{-- <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script> --}}
    <!-- Bootstrap JS-->
    {{-- <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script> --}}
    <!-- Vendor JS       -->
    {{-- <script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script> --}}

    <!-- Main JS-->
    {{-- <script src="js/main.js"></script> --}}

    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

@yield('scriptSection')

</html>
<!-- end document-->
