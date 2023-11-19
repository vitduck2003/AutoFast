<!doctype html> <html lang="en"> <head> <meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="utf-8"> <title>Saas Dashboard | Skote - Responsive Bootstrap 4 Admin Dashboard</title> <meta
    name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description"> <meta content="Themesbrand"
    name="author"> <!-- App favicon -->
<link rel="shortcut icon" href="{{asset('assets\images\favicon.ico')}}"> <link rel="shortcut icon" href="{{
    asset('assets/images/favicon.ico') }}"> <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
        alpha/css/bootstrap.css"
        rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/fdb36d9438.js" crossorigin="anonymous"></script>
    <link rel=" stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> <script
    src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
</script>
<!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css">

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"> <!-- App Css--> <link
    href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
integrity="sha384-KEK5TbkdQW1XGmT0cNz4Z/6bH/2Cx5Hr0k2g8h7WkM0I6jbf8uaDn5jI6vSgjgTZ" crossorigin="anonymous">
<style>




.drop-container {
position: relative;
display: flex;
gap: 10px;
flex-direction: column;
justify-content: center;
align-items: center;
height: 200px;
padding: 20px;
border-radius: 10px;
border: 2px dashed #555;
color: #444;
cursor: pointer;
transition: background .2s ease-in-out, border .2s ease-in-out;
}

.drop-container:hover,
.drop-container.drag-active {
background: #eee;
border-color: #111;
}

.drop-container:hover .drop-title,
.drop-container.drag-active .drop-title {
color: #222;
}

.drop-title {
color: #444;
font-size: 20px;
font-weight: bold;
text-align: center;
transition: color .2s ease-in-out;
}

input[type=file] {
width: 350px;
max-width: 100%;
color: #444;
padding: 5px;
background: #fff;
border-radius: 10px;
border: 1px solid #555;
}

input[type=file]::file-selector-button {
margin-right: 20px;
border: none;
background: #084cdf;
padding: 10px 20px;
border-radius: 10px;
color: #fff;
cursor: pointer;
transition: background .2s ease-in-out;
}

input[type=file]::file-selector-button:hover {
background: #0d45a5;
}
</style>
</head>

<body data-sidebar="dark"> <div id="layout-wrapper">

    <header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
        <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
            <img src="{{ asset('assets\images\logo.svg') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
            <img src="{{ asset('assets\images\logo-dark.png') }} "alt="" height="17">
            </span>
            </a>

            <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
            <img src="{{asset('assets\images\logo-light.svg')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
            <img src="{{ asset('assets\images\logo-light.png') }}" alt="" height="19">
            </span>
            </a>
        </div>

        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
        id="vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
        </button>

        <!-- App Search-->
        <form class="app-search d-none d-lg-block">
        <div class="position-relative">
            <input type="text" class="form-control" placeholder="Search...">
            <span class="bx bx-search-alt"></span>
        </div>
        </form>


        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ml-2">
            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                aria-labelledby="page-header-search-dropdown">

                <form class="p-3">
                <div class="form-group m-0">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search ..."
                    aria-label="Recipient's username">
                    <div class="input-group-append">
                    <button class="btn btn-primary" type="submit"><i
                    class="mdi mdi-magnify"></i>
            </button>
            </div>
            </div>
        </div>
        </form>
        </div>
    </div>

    <div class="dropdown d-inline-block">
    <button type="button" class="btn header-item waves-effect" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false"> <img class="" src="{{ asset('assets\images\flags\us.jpg') }}" alt="Header Language"
        height="16">
    </button>
    <div class="dropdown-menu dropdown-menu-right">

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <img src="{{ asset('assets\images\flags\spain.jpg') }}" alt="user-image" class="mr-1" height="12"> <span
                class="align-middle">Spanish</span>
        </a>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <img src="{{ asset('assets\images\flags\germany.jpg') }} "alt="user-image" class="mr-1" height="12"> <span
                class="align-middle">German</span>
        </a>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <img src="{{ asset('assets\images\flags\italy.jpg') }}" alt="user-image" class="mr-1" height="12"> <span
                class="align-middle">Italian</span>
        </a>

        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <img src="{{ asset('assets\images\flags\russia.jpg') }}" alt="user-image" class="mr-1" height="12"> <span
                class="align-middle">Russian</span>
        </a>
    </div>
    </div>

    <div class="dropdown d-none d-lg-inline-block ml-1">
        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="bx bx-customize"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="px-lg-2">
                <div class="row no-gutters">
                    <div class="col">
                        <a class="dropdown-icon-item" href="#">
                            <img src="{{ asset('assets\images\brands\github.png') }}" alt="Github">
                            <span>GitHub</span>
                        </a>
                    </div>
                    <div class="col">
                        <a class="dropdown-icon-item" href="#">
                            <img src="{{ asset('assets\images\brands\bitbucket.png') }}" alt="bitbucket">
                            <span>Bitbucket</span>
                        </a>
                    </div>
                    <div class="col">
                        <a class="dropdown-icon-item" href="#">
                            <img src="{{ asset('assets\images\brands\dribbble.png') }} "alt="dribbble">
                            <span>Dribbble</span>
                        </a>
                    </div>
                </div>

                <div class="row no-gutters">
                    <div class="col">
                        <a class="dropdown-icon-item" href="#">
                            <img src="{{ asset('assets\images\brands\dropbox.png') }}" alt="dropbox">
                            <span>Dropbox</span>
                        </a>
                    </div>
                    <div class="col">
                        <a class="dropdown-icon-item" href="#">
                            <img src="{{ asset('assets\images\brands\mail_chimp.png') }}" alt="mail_chimp">
                            <span>Mail Chimp</span>
                        </a>
                    </div>
                    <div class="col">
                        <a class="dropdown-icon-item" href="#">
                            <img src="{{ asset('assets\images\brands\slack.png') }}" alt="slack">
                            <span>Slack</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dropdown d-none d-lg-inline-block ml-1">
        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
            <i class="bx bx-fullscreen"></i>
        </button>
    </div>

    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-bell bx-tada"></i>
            <span class="badge badge-danger badge-pill">3</span>
        </button>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
            aria-labelledby="page-header-notifications-dropdown">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0"> Notifications </h6>
                    </div>
                    <div class="col-auto">
                        <a href="#!" class="small"> View All</a>
                    </div>
                </div>
            </div>
            <div data-simplebar="" style="max-height: 230px;">
                <a href="" class="text-reset notification-item">
                    <div class="media">
                        <div class="avatar-xs mr-3">
                            <span class="avatar-title bg-primary rounded-circle font-size-16">
                                <i class="bx bx-cart"></i>
                            </span>
                        </div>
                        @if(Auth::user())
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">{{ Auth::user()->name }}: đã đặt lịch</h6>
                            <div class="font-size-12 text-muted">
                                <p class="mb-1">If several languages coalesce the grammar</p>
                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </a>
                <a href="" class="text-reset notification-item">
                    <div class="media">
                        <img src={{ asset('assets\images\users\avatar-3.jpg') }} class="mr-3 rounded-circle avatar-xs"
                            alt="user-pic">
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">James Lemire</h6>
                            <div class="font-size-12 text-muted">
                                <p class="mb-1">It will seem like simplified English.</p>
                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="" class="text-reset notification-item">
                    <div class="media">
                        <div class="avatar-xs mr-3">
                            <span class="avatar-title bg-success rounded-circle font-size-16">
                                <i class="bx bx-badge-check"></i>
                            </span>
                        </div>
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">Your item is shipped</h6>
                            <div class="font-size-12 text-muted">
                                <p class="mb-1">If several languages coalesce the grammar</p>
                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="" class="text-reset notification-item">
                    <div class="media">
                        <img src="assets\images\users\avatar-4.jpg" class="mr-3 rounded-circle avatar-xs"
                            alt="user-pic">
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">Salena Layfield</h6>
                            <div class="font-size-12 text-muted">
                                <p class="mb-1">As a skeptical Cambridge friend of mine occidental.
                                </p>
                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="p-2 border-top">
                <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                    <i class="mdi mdi-arrow-right-circle mr-1"></i> View More..
                </a>
            </div>
        </div>
    </div>

    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <img class="rounded-circle header-profile-user" src="{{ session('avatar') ? Storage::url(session('avatar')) : '' }}"
                >
            <span class="d-none d-xl-inline-block ml-1">{{session('user_name')}}</span>
            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <!-- item-->
            <a class="dropdown-item" href=""><i
                                    class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i
                                    class="bx bx-wallet font-size-16 align-middle mr-1"></i> My Wallet</a>
                            <a class="dropdown-item d-block" href="#"><span
                                    class="badge badge-success float-right">11</span><i
                                    class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a>
                            <a class="dropdown-item" href="{{ url('admin/profile/show/password', ['id' => session('id')]) }}"><i
                                    class="bx bx-lock-open font-size-16 align-middle mr-1"></i> Change password</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                    class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>Logout</a>
        </div>
    </div>

    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
            <i class="bx bx-cog bx-spin"></i>
        </button>
    </div>

    </div>
    </div>
    </header>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar="" class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Menu</li>

                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="bx bx-home-circle"></i><span
                                    class="badge badge-pill badge-info float-right">03</span>
                                <span>Dashboards</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="index.html">Default</a></li>
                                <li><a href="dashboard-saas.html">Saas</a></li>
                                <li><a href="dashboard-crypto.html">Crypto</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Đặt lịch</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-file"></i>
                                <span>Quản lí đặt lịch</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ url('admin/bookings') }}">Lịch đang chờ xác nhận</a></li>
                                <li><a href="{{ url('admin/bookings-wait') }}">Lịch đang chờ khách đến</a></li>
                                <li><a href="{{ url('admin/bookings-complete') }}">Lịch đã hoàn thành</a></li>
                                <li><a href="{{ url('admin/bookings-cancel') }}">Lịch đã hủy</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Công việc</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-file"></i>
                                <span>Quản lí công việc</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ url('admin/jobs') }}">Công việc đang làm</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Hóa đơn</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-file"></i>
                                <span>Quản lí hóa đơn</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('invoice') }}">Tất cả hóa đơn</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Dịch vụ</li>
                        <li>
                            <a class="has-arrow waves-effect">
                                <i class="bx bx-tone"></i>
                                <span>Quản lí dịch vụ</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('service.index') }}">Tất cả phụ tùng</a></li>
                         
                            </ul>
                        </li>
                        <li class="menu-title">Phụ Tùng</li>
                        <li>
                            <a class="has-arrow waves-effect">
                                <i class="bx bx-tone"></i>
                                <span>Quản lí phụ tùng</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('serviceitem.index') }}">Tất cả phụ tùng</a></li>
                               
                            </ul>
                        </li>
                        <li class="menu-title">Khuyến Mại</li>
                        <li>
                            <a class="has-arrow waves-effect">
                                <i class="bx bx-tone"></i>
                                <span>Quản lí khuyến mại</span>
                            </a>

                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('coupon.list_coupon') }}">Tất cả mã giảm giá</a></li>
                               
                            </ul>

                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('coupon.form.add') }}">Thêm mã giảm giá</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Tài khoản</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-list-ul"></i>
                                <span>Quản lí tài khoản</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('admin/user') }}">Danh sách tài khoản</a></li>
                        </ul>
                        </li>
                        <li class="menu-title">Nhân viên</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-list-ul"></i>
                                <span>Quản lí nhân viên</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ url('admin/staff') }}">Tất cả nhân viên</a></li>
                            </ul>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ url('admin/staff/form/add') }}">Thêm nhân viên</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Tin tức</li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-list-ul"></i>
                            <span>Quản lí tin tức</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('new.index')}}">tất cả tin tức</a></li>
                        </ul>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('new.create')}}">them tin tuc</a></li>
                        </ul>
                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Saas</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                    <li class="breadcrumb-item active">Saas</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                </div>
                @yield('content')
            </div> <!-- container-fluid -->
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © Skote.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                            Design & Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

    </div>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Saas dashboard init -->
    <script src="{{ asset('assets/js/pages/saas-dashboard.init.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    @yield('script');
</body>