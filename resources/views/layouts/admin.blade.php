<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @if(View::hasSection('title'))
            @yield('title')
        @else
            {{ config('app.name', 'Laravel') }}
        @endif
    </title>

    <link rel="stylesheet" href="{{ asset('/css/admin/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/dt-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/dt-gradients.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/dt-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/dt-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/toast.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/general.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js" integrity="sha512-oL84kLQMEPIS350nZEpvFH1whU0HHGNUDq/X3WBdDAvKP7jn06gHTsCsymsoPYKF/duN8ZxzzvQgOaaZSgcYtQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore.js" integrity="sha512-c2h4K/PN8OFjpm7r4Y+a10axJm1XrrK0HP3EhMGBTgK6RJY3bdiQNGwFIDs9uohgWtQ/+fRhTi3v8iYvHVriRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
@php
    $user = Auth::user();
@endphp
<body>
    <div id="wrapper" class="toggled">
        <div id="sidebar-wrapper" class="harmonic">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a>
                        Hello, {{ $user->name }}
                    </a>
                </li>
                <li>
                    <a href="/admin/dashboard">
                        <i class="fas fa-home" aria-hidden="true"></i> &nbsp;Trang chính
                    </a>
                </li>
                <li>
                    <a href="/admin/products">
                        <i class="fab fa-product-hunt" aria-hidden="true"></i> &nbsp;Quản lý sản phẩm
                    </a>
                </li>
                <li>
                    <a href="/admin/categories">
                        <i class="fa fa-building" aria-hidden="true"></i> &nbsp;Quản lý các mục
                    </a>
                </li>
                <li>
                    <a href="/admin/users">
                        <i class="fa fa-users" aria-hidden="true"></i>&nbsp;Quản lý người dùng
                    </a>
                </li>
                <li>
                    <a href="/admin/orders">
                        <i class="fas fa-hand-pointer" aria-hidden="true"></i>&nbsp; Xử lý đơn hàng
                    </a>
                </li>
                <li>
                    <a href="/admin/invoices">
                        <i class="fas fa-file-invoice" aria-hidden="true"></i>&nbsp; Quản lý hóa đơn
                    </a>
                </li>
                <li>
                    <a href="/admin/stores">
                        <i class="fa fa-store" aria-hidden="true"></i>&nbsp;Quản lý cửa hàng
                    </a>
                </li>
                <li>
                    <a href="/admin/api-key">
                        <i class="fa fa-key" aria-hidden="true"></i>&nbsp;Quản lý khóa
                    </a>
                </li>
                <li>
                    <a href="/admin/profile">
                        <i class="fas fa-user-cog" aria-hidden="true"></i>&nbsp;Tài khoản của tôi
                    </a>
                </li>
            </ul>
        </div>
        <div id="page-content-wrapper">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button
                            type="button"
                            class="navbar-toggle collapsed"
                            data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1"
                            aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#menu-toggle" id="menu-toggle">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </a>
                        <a class="navbar-brand" href="/">Back to pos</a>
                    </div>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/js/admin/simple-sidebar.js') }}"></script>
    <script src="{{ asset('/js/admin/plugins.js') }}"></script>
</body>
</html>
