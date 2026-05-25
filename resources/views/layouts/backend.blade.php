<!DOCTYPE html>
<html lang="en">

    <head>

        <!-- =========================================
        META
        ========================================= -->
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible"
              content="IE=edge">

        <meta name="viewport"
              content="width=device-width, initial-scale=1">

        <meta name="csrf-token"
              content="{{ csrf_token() }}">

        <title>@yield('title', 'FALGUN Admin Panel')</title>

        <!-- =========================================
        GOOGLE FONT
        ========================================= -->
        <link rel="preconnect"
              href="https://fonts.googleapis.com">

        <link rel="preconnect"
              href="https://fonts.gstatic.com"
              crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
              rel="stylesheet">

        <!-- =========================================
        BOOTSTRAP
        ========================================= -->
        <link rel="stylesheet"
              href="{{ asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

        <!-- =========================================
        FONT AWESOME
        ========================================= -->
        <link rel="stylesheet"
              href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">

        <!-- =========================================
        IONICONS
        ========================================= -->
        <link rel="stylesheet"
              href="{{ asset('assets/bower_components/Ionicons/css/ionicons.min.css') }}">

        <!-- =========================================
        ADMIN LTE
        ========================================= -->
        <link rel="stylesheet"
              href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">

        <link rel="stylesheet"
              href="{{ asset('assets/dist/css/skins/skin-green.min.css') }}">

        <!-- =========================================
        SWEET ALERT
        ========================================= -->
        <link rel="stylesheet"
              href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}">

        @include('sweetalert::alert')

        <!-- PAGE CSS -->
        @yield('top')

        <!-- =========================================
        CUSTOM ADMIN STYLE
        ========================================= -->
        <style>

            body{
                font-family:'Inter', sans-serif;
                background:#f4f6f9;
               font-size: 12px !important;
            }

            .main-header .logo{
                background:#111 !important;
                color:#fff !important;
                border:none !important;
                font-weight:700;
                font-size:20px;
            }

            .main-header .navbar{
                background:#1f2937 !important;
            }

            .skin-green .main-header .navbar .sidebar-toggle:hover{
                background:rgba(255,255,255,.08);
            }

            .main-sidebar{
                background:#111827 !important;
            }

            .sidebar-menu>li>a{
                padding:14px 18px;
                font-weight:500;
                transition:.3s;
            }

            .sidebar-menu>li>a:hover{
                background:#1f2937 !important;
                padding-left:24px;
            }

            .sidebar-menu>li.active>a{
                background:#10b981 !important;
                color:#fff !important;
            }

            .content-wrapper{
                background:#f5f7fb;
                min-height:100vh;
            }

            .content-header h1{
                font-weight:700;
            }

            .box{
                border:none;
                border-radius:16px;
                overflow:hidden;
                box-shadow:0 5px 20px rgba(0,0,0,.05);
            }

            .box-header{
                border-bottom:1px solid #f1f1f1;
                padding:18px 20px;
            }

            .box-title{
                font-weight:700;
            }

            .btn{
                border-radius:10px;
                transition:.3s;
                font-weight:600;
            }

            .btn:hover{
                transform:translateY(-2px);
            }

            .table>thead>tr>th{
                border-bottom:1px solid #eee;
                font-weight:700;
                padding:14px;
            }

            .table>tbody>tr>td{
                padding:5px;
                vertical-align:middle;
                font-size: 12px;
            }

            .form-control{
                border-radius:10px;
                box-shadow:none;
                border:1px solid #ddd;
                height:44px;
            }

            textarea.form-control{
                height:auto;
            }

            .user-menu .user-image{
                border-radius:50%;
                object-fit:cover;
            }

            .dropdown-menu{
                border:none;
                border-radius:14px;
                overflow:hidden;
                box-shadow:0 15px 40px rgba(0,0,0,.12);
            }

            .user-header{
                background:#10b981 !important;
            }

            .content{
                padding:25px;
            }

            .small-box{
                border-radius:18px;
                overflow:hidden;
            }

            .small-box>.inner{
                padding:20px;
            }

            .small-box h3{
                font-size:34px;
                font-weight:800;
            }

            .small-box-footer{
                background:rgba(0,0,0,.08);
            }

            @media(max-width:768px){

                .content{
                    padding:15px;
                }

                .main-header .logo{
                    font-size:16px;
                }

            }

        </style>

    </head>

    <body class="hold-transition skin-green sidebar-mini fixed">

        <div class="wrapper">

            <!-- =========================================
            HEADER
            ========================================= -->
            <header class="main-header">

                <!-- LOGO -->
                <a href="{{ route('admin.dashboard') }}"
                   class="logo">

                    <span class="logo-mini">
                        <b>F</b>
                    </span>

                    <span class="logo-lg">
                        <b>FALGUN</b> 
                    </span>

                </a>

                <!-- NAVBAR -->
                <nav class="navbar navbar-static-top"
                     role="navigation">

                    <!-- SIDEBAR TOGGLE -->
                    <a href="#"
                       class="sidebar-toggle"
                       data-toggle="push-menu"
                       role="button">

                        <span class="sr-only">
                            Toggle navigation
                        </span>

                    </a>

                    <!-- RIGHT MENU -->
                    <div class="navbar-custom-menu">

                        <ul class="nav navbar-nav">

                            <!-- USER -->
                            <li class="dropdown user user-menu">

                                <a href="#"
                                   class="dropdown-toggle"
                                   data-toggle="dropdown">

                                    <img src="{{ asset('user-profile.png') }}"
                                         class="user-image"
                                         alt="User Image">

                                    <span class="hidden-xs">
                                        {{ Auth::user()->name }}
                                    </span>

                                </a>

                                <ul class="dropdown-menu">

                                    <!-- USER IMAGE -->
                                    <li class="user-header">

                                        <img src="{{ asset('user-profile.png') }}"
                                             class="img-circle"
                                             alt="User Image">

                                        <p>

                                            {{ Auth::user()->name }}

                                            <small>
                                                {{ Auth::user()->email }}
                                            </small>

                                        </p>

                                    </li>

                                    <!-- MENU FOOTER -->
                                    <li class="user-footer">

                                        <div class="pull-left">

                                            <a href="{{ route('admin.profile.edit') }}"
                                               class="btn btn-success btn-flat">
                                                Profile
                                            </a>

                                        </div>

                                        <div class="pull-right">

                                            <a href="{{ route('logout') }}"
                                               class="btn btn-danger btn-flat"
                                               onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">

                                                Logout

                                            </a>

                                            <form id="logout-form"
                                                  action="{{ route('logout') }}"
                                                  method="POST"
                                                  style="display:none;">

                                                @csrf

                                            </form>

                                        </div>

                                    </li>

                                </ul>

                            </li>

                        </ul>

                    </div>

                </nav>

            </header>

            <!-- =========================================
            SIDEBAR
            ========================================= -->
            @include('layouts.sidebar')

            <!-- =========================================
            CONTENT
            ========================================= -->
            <div class="content-wrapper">
                <div style="padding: 15px" class="">

                    @yield('content')
                </div>

            </div>

            <!-- =========================================
            FOOTER
            ========================================= -->
            <footer class="main-footer">

                <div class="pull-right hidden-xs">
                    FALGUN Sample Management System
                </div>

                <strong>
                    © {{ date('Y') }}
                    FALGUN.
                </strong>

                All rights reserved.

            </footer>

        </div>

        <!-- =========================================
        JQUERY
        ========================================= -->
        <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>

        <!-- =========================================
        BOOTSTRAP JS
        ========================================= -->
        <script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

        <!-- =========================================
        ADMIN LTE JS
        ========================================= -->
        <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

        <!-- =========================================
        SWEET ALERT
        ========================================= -->
        <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>

        <!-- PAGE SCRIPTS -->
        @yield('bot')

    </body>

</html>