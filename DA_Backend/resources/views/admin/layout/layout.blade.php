<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <title>Admin | AutoFast</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author"> <!-- App favicon -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
    <link rel="shortcut icon" href="{{ asset('assets\images\favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
        alpha/css/bootstrap.css"
        rel="stylesheet">
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/fdb36d9438.js" crossorigin="anonymous"></script>
    <link rel=" stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"> <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"
        integrity="sha384-KEK5TbkdQW1XGmT0cNz4Z/6bH/2Cx5Hr0k2g8h7WkM0I6jbf8uaDn5jI6vSgjgTZ" crossorigin="anonymous">
    <style>
        .employee-details {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .employee-details h2 {
            text-align: center;
        }

        .employee-details p {
            margin-bottom: 10px;
        }

        .employee-details img {
            display: block;
            margin: 0 auto;
            width: 200px;
            height: auto;
            border-radius: 50%;
        }

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

<body data-sidebar="dark">
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <div class="navbar-brand-box">
                        <a href="home" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('assets\images\logo\logo.png') }}" width="100%"  height="max">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets\images\logo\logo.png') }}" width="100%" height="100%">
                            </span>
                        </a>

                        <a href="home" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('assets\images\logo\logo.png') }}" width="100%"  height="100%"
                                    width="30px">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('assets\images\logo\logo.png') }}" width="100%" height="100%">
                            </span>
                        </a>
                    </div>
                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">

                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>
                <div class="d-flex">

                


                    <div class="dropdown d-none d-lg-inline-block ml-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="bx bx-bell bx-tada"></i>
                            <span class="badge badge-danger badge-pill"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" id="show_noti"
                            aria-labelledby="page-header-notifications-dropdown">
                        </div>

                    </div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="{{ session('avatar') ? Storage::url(session('avatar')) : 'https://png.pngtree.com/png-vector/20210128/ourlarge/pngtree-flat-default-avatar-png-image_2848906.jpg' }}" >
                            <span class="d-none d-xl-inline-block ml-1">{{ session('user_name') }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a class="dropdown-item" href="{{ url('admin/profile', ['id' => session('id')]) }}"><i
                                    class="bx bx-user font-size-16 align-middle mr-1"></i> Thông tin cá nhân</a>
                            <a class="dropdown-item"
                                href="{{ url('admin/profile/show/password', ['id' => session('id')]) }}"><i
                                    class="bx bx-lock-open font-size-16 align-middle mr-1"></i> Đổi mật khẩu</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                    class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>Đăng
                                xuất</a>
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
                            <a href="{{ route('admin.home') }}" class="waves-effect">
                            <i class="fa-solid fa-house"></i>
                                <span>Trang chủ</span>
                            </a>

                        </li>
                        <li class="menu-title">Đặt lịch</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa-solid fa-calendar-days"></i>
                                <span>Quản lí đặt lịch</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <span class="badge badge-pill badge-danger float-right" id="bookingPen"></span>
                                <li><a href="{{ url('admin/bookings') }}">Lịch đang chờ xác nhận</a></li>
                                <span class="badge badge-pill badge-danger float-right" id="bookingWait"></span>
                                <li><a href="{{ url('admin/bookings-wait') }}">Lịch đang chờ khách đến</a></li>
                                <span class="badge badge-pill badge-danger float-right" id="bookingPrio"></span>
                                <li><a href="{{ url('admin/bookings-priority') }}">Lịch ưu tiên & chưa có phòng</a>
                                </li>
                                <span class="badge badge-pill badge-danger float-right" id="bookingCom"></span>
                                <li><a href="{{ url('admin/bookings-complete') }}">Lịch đã hoàn thành</a></li>
                                <span class="badge badge-pill badge-danger float-right" id="bookingCan"></span>
                                <li><a href="{{ url('admin/bookings-cancel') }}">Lịch đã hủy</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Công việc</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa-solid fa-briefcase"></i>
                                <span>Quản lí công việc</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <span class="badge badge-pill badge-danger float-right" id="bookingDoing"></span>
                                <li><a href="{{ url('admin/jobs') }}">Lịch đang làm</a></li>
                                <li><a href="{{ url('admin/staffJob') }}">Nhân viên và công việc</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Cầu</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa-solid fa-warehouse"></i>
                                <span>Quản lí cầu</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <span class="badge badge-pill badge-danger float-right" id="bookingDoing"></span>
                                <li><a href="{{ url('admin/room') }}">Danh sách cầu</a></li>
                                <li><a href="{{ url('admin/room/formAdd') }}">Thêm cầu</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Hóa đơn</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa-solid fa-file-invoice"></i>
                                <span>Quản lí hóa đơn</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('invoice') }}">Tất cả hóa đơn</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Dịch vụ</li>
                        <li>
                            <a class="has-arrow waves-effect">
                            <i class="fa-solid fa-screwdriver-wrench"></i>                                
                            <span>Quản lí dịch vụ</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('service.index') }}">Tất cả dịch vụ</a></li>

                            </ul>
                        </li>
                        <li class="menu-title">Phụ Tùng</li>
                        <li>
                            <a class="has-arrow waves-effect">
                            <i class="fa-solid fa-wrench"></i>                                
                            <span>Quản lí phụ tùng</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('serviceitem.index') }}">Tất cả phụ tùng</a></li>

                            </ul>
                        </li>
                        <li class="menu-title">Khuyến Mại</li>
                        <li>
                            <a class="has-arrow waves-effect">
                            <i class="fa-solid fa-ticket"></i>
                                <span>Quản lí khuyến mại</span>
                            </a>

                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('coupon.list_coupon') }}">Tất cả mã giảm giá</a></li>
                                <li><a href="{{ route('coupon.form.add') }}">Thêm mã giảm giá</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Tài khoản</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa-solid fa-circle-user"></i>
                                <span>Quản lí tài khoản</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ url('admin/user') }}">Danh sách tài khoản</a></li>
                            </ul>
                        </li>
                        <li class="menu-title">Nhân viên</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa-solid fa-users-gear"></i>
                                <span>Quản lí nhân viên</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ url('admin/staff') }}">Tất cả nhân viên</a></li>
                                <li><a href="{{ url('admin/staff-action') }}">Danh sách nhân viên không hoạt động</a>
                                </li>

                            </ul>
                        </li>
                        <li class="menu-title">Đánh giá</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa-solid fa-star"></i>
                                <span>Quản lí Đánh giá</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ url('admin/reviews') }}">Tất cả đánh giá</a></li>
                                <li><a href="{{ url('admin/reviews/delete') }}">Tất cả đánh giá đã xóa</a></li>
                            </ul>
                        </li>

                        <li class="menu-title">Tin tức</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="fa-solid fa-newspaper"></i>
                                <span>Quản lí tin tức</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('new.index') }}">Tất cả tin tức</a></li>
                                <li><a href="{{ route('new.create') }}">Tạo tin tức</a></li>
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
                                <h4 class="mb-0 font-size-18">ADMIN</h4>
                                {{-- <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                        <li class="breadcrumb-item active">Saas</li>
                                    </ol>
                                </div> --}}
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
                            </script> DINH ViT DUCK
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Design & Develop by DINH VIET DUC
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <script>
      $(document).ready(function() {
    $.ajax({
        url: '/api/booking-info',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            $('#bookingPen').text(data.bookingPending);
            $('#bookingWait').text(data.bookingWait);
            $('#bookingPrio').text(data.bookingPrio);
            $('#bookingCom').text(data.bookingComplete);
            $('#bookingCan').text(data.bookingCancel);
            $('#bookingDoing').text(data.bookingDoing);

            if (data.bookingPending == 0) {
                $('#bookingPen').css('display', 'none');
            }
            if (data.bookingWait == 0) {
                $('#bookingWait').css('display', 'none');
            }
            if (data.bookingPrio == 0) {
                $('#bookingPrio').css('display', 'none');
            }
            if (data.bookingComplete == 0) {
                $('#bookingCom').css('display', 'none');
            }
            if (data.bookingCancel == 0) {
                $('#bookingCan').css('display', 'none');
            }
            if (data.bookingDoing == 0) {
                $('#bookingDoing').css('display', 'none');
            }
        },
        error: function() {
            console.log('Kết nối API thất bại');
        }
    });

    const show_noti = document.getElementById('show_noti');
    fetch('/api/admin/notifications')
        .then(response => {
            if (!response.ok) {
                throw new Error('Lỗi khi gọi API');
            }
            return response.json();
        })
        .then(data => {
            const recentNotifications = data.slice(0, 3);
            var content = recentNotifications.map(function(data) {
                return `
                    <div data-simplebar="" style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">${data.title}</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">${data.content} ${data.name}</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> ${data.display_time}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                `;
            }).join('');

            show_noti.innerHTML = `
                <div class="p-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="m-0">Thông báo</h6>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('notifications-view') }}" class="small">View All</a>
                        </div>
                    </div>
                </div>
            ` + content + `
                <div class="p-2 border-top">
                    <a class="btn btn-sm btn-link fonte-14 btn-block text-center" href="">
                        <i class="mdi mdi-arrow-right-circle mr-1"></i>View More..
                    </a>
                </div>
            `;
        })
        .catch(error => {
            console.error(error);
        });

    // Kích hoạt plugin MetisMenu
    $('#side-menu').metisMenu();

    // Xử lý sự kiện nhấp vào mục menu cha
    $('#side-menu .menu-title').on('click', function(e) {
        e.preventDefault();
        $(this).toggleClass('active').next('.submenu').slideToggle(200);
    });
});
    </script>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

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
    <script src="{{ asset('assets/js/app.js') }}" defer></script>

    @yield('script');

</body>
