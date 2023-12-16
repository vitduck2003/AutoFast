@extends('admin/layout/layout')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('content')
    <div class="row">
        <div class="col-xl-4">
            <div class="card overflow-hidden">
                <div class="bg-soft-primary">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-3">
                                <h5 class="text-primary">Chào mừng trở lại !</h5>
                                <p>Thống kê đặt lịch</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="assets\images\profile-img.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="avatar-md profile-user-wid mb-3">
                                <img src="{{ session('avatar') ? Storage::url(session('avatar')) : '' }}" alt=""
                                    class="img-thumbnail rounded-circle">
                            </div>
                            <p class="text-muted mb-0 text-truncate">Xin chào !</p>
                            <h5 class="font-size-15 text-truncate">{{ session('user_name') }}</h5>
                        </div>

                        <div class="col-sm-8">
                            <div class="pt-4">

                                <div class="row" class="mx-auto">
                                    <div class="col-6">
                                        <p class="text-muted mb-0">Chưa xác nhận</p>
                                        <h5 class="font-size-15">{{ $pendingBookingsCount }}</h5>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-muted mb-0">Đã hoàn thành</p>
                                        <h5 class="font-size-15">{{ $completeBookingsCount }}</h5>
                                    </div>
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <h4 class="card-title m-3">Thống kê dịch vụ được đặt</h4>
                <div class="card-body">
                    <canvas id="pie-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Tổng lịch đặt nay</p>
                                    <h4 class="mb-0">{{ $allBookingToday }}</h4>
                                </div>

                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                    <span class="avatar-title">
                                        <i class="bx bx-calendar font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Tổng lịch hoàn thành</p>
                                    <h4 class="mb-0">{{ $completeBookingsCount }}</h4>
                                </div>

                                <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-calendar-check font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Lịch đang chờ khách</p>
                                    <h4 class="mb-0">{{ $waitBookingsCount }}</h4>
                                </div>

                                <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class='bx bxs-calendar' ></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Lịch đang làm</p>
                                    <h4 class="mb-0">{{ $ongoingBookingsCount }}</h4>
                                </div>

                                <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class='bx bxs-calendar-plus' ></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Lịch đã hủy</p>
                                    <h4 class="mb-0">{{ $canceledBookingsCount }}</h4>
                                </div>

                                <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                        <i class="bx bx-calendar-x font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4 float-sm-left">Thống kê</h4>
                    <div class="float-sm-right">
                        <select id="chart-option"  class="form-control">
                            <option value="week">Tuần</option>
                            <option value="month">Tháng</option>
                            <option value="year">Năm</option>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card ">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-4">Doanh thu</h4>
                        </div>
                        <div class="mb-3">
                            <select id="revenue-option" class="form-control">
                                <option value="today">Hôm nay</option>
                                <option value="week">Tuần</option>
                                <option value="month">Tháng</option>
                                <option value="year">Năm</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="text-muted">
                                <span id="desc" class="text-success mr-2"></span>
                                Doanh thu thật tuyệt vời
                            </p>
                            <h3 id="revenue-value">{{ number_format($todayRevenue, 0, ',', '.') }} đ</h3>
                            <p class="mt-4">
                                Xin chào! Chúc bạn ngày mới vui vẻ
                            </p>
                           
                        </div>
                        <div class="col-sm-6">
                            <div class="mt-4 mt-sm-0">
                                <div id="radialBar-chart" class="apex-charts"></div>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mb-0"></p>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Các dịch vụ</h4>
                    <ul class="verti-timeline list-unstyled">
                        @foreach ($services as $service)
                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                            </div>
                            <div class="media">
                                <div class="mr-3">
                                    <h5 class="font-size-14">{{ ucwords(strtolower($service->service_name))  }}<i
                                            class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ml-2"></i>
                                    </h5>
                                </div>
                                <div class="media-body">
                                    <div>
                                        Trọn Gói {{ ucwords(strtolower($service->service_name))  }}
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div class="text-center mt-5"><a href="{{ url('service') }}"
                            class="btn btn-primary waves-effect waves-light btn-sm">Đến quản lí<i
                                class="mdi mdi-arrow-right ml-1"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Nhân viên</h4>
                    <div class="text-center">
                        <div class="mb-4">
                            <i class="bx bx-map-pin text-primary display-4"></i>
                        </div>
                        <h3>{{ $staff }}</h3>
                        <p>Nhân viên</p>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table table-centered table-nowrap">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">
                                        <p class="mb-0">Nhân viên đang rảnh</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h5 class="mb-0">{{ $staffFreeTime }}</h5>
                                    </td>
                                    <td>
                                        <div class="progress bg-transparent progress-sm">
                                            <div class="progress-bar bg-primary rounded" role="progressbar"
                                                style="width: 94%" aria-valuenow="94" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="mb-0">Nhân viên đang làm</p>
                                    </td>
                                    <td>
                                        <h5 class="mb-0">{{ $staffOn }}</h5>
                                    </td>
                                    <td>
                                        <div class="progress bg-transparent progress-sm">
                                            <div class="progress-bar bg-success rounded" role="progressbar"
                                                style="width: 82%" aria-valuenow="82" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="mb-0">Nhân viên nghỉ</p>
                                    </td>
                                    <td>
                                        <h5 class="mb-0">{{ $staffOff }}</h5>
                                    </td>
                                    <td>
                                        <div class="progress bg-transparent progress-sm">
                                            <div class="progress-bar bg-warning rounded" role="progressbar"
                                                style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-1"><a href="{{  url('admin/staff') }}"
                        class="btn btn-primary waves-effect waves-light btn-sm">Đến quản lí<i
                            class="mdi mdi-arrow-right ml-1"></i></a>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Hóa đơn gần đây</h4>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Tên khách</th>
                                    <th>Ngày tạo</th>
                                    <th>Tổng tiền</th>
                                    <th>Trang thái thanh toán</th>
                                    <th>Kiểu thanh toán</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($bill5 as $bill)
                                    <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">{{ $bill->id }}</a>
                                    </td>
                                    <td>{{ $bill->name }}</td>
                                    <td>
                                        {{$bill->created_at}}
                                    </td>
                                    <td>
                                        {{ number_format($bill->total_amount, 0, ',', '.') }} đ
                                    </td>
                                    <td>
                                      @if($bill->status_payment == "Đã thanh toán")
                                      <span class="badge badge-pill badge-soft-success font-size-12">{{ $bill->status_payment }}</span>
                                      @endif
                                      @if($bill->status_payment == "Chưa thanh toán")
                                      <span class="badge badge-pill badge-soft-danger font-size-12">{{ $bill->status_payment }}</span>
                                      @endif
                                    </td>
                                    <td>
                                        <i class="fab fa-cc-mastercard mr-1"></i> ATM
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <a href="{{route('detail.invoice', ['id'=>$bill->id]) }}"><button type="button"
                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                            data-toggle="modal" data-target=".exampleModal">
                                           Chi tiết
                                        </button></a>
                                    </td>
                                </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    </div>
    <!-- container-fluid -->
    </div>
    <script>
        var bookingOfYear = {!! json_encode($bookingOfYear) !!};
        var years = Object.keys(bookingOfYear);
        var newCategories = [];
        var yearData = [];
        for (var i = 0; i < years.length; i++) {
            newCategories.push(years[i]);
        }
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                chart: {
                    type: 'bar',
                    height: 310,
                    stacked: true,
                },
                series: [],
                xaxis: {
                    categories: [],
                },
            };

            var weekData = [{
                    name: 'Lịch đã đặt',
                    data: [
                        {{ $bookingOfWeek['Monday']['bookings'] }},
                        {{ $bookingOfWeek['Tuesday']['bookings'] }},
                        {{ $bookingOfWeek['Wednesday']['bookings'] }},
                        {{ $bookingOfWeek['Thursday']['bookings'] }},
                        {{ $bookingOfWeek['Friday']['bookings'] }},
                        {{ $bookingOfWeek['Saturday']['bookings'] }},
                        {{ $bookingOfWeek['Sunday']['bookings'] }}
                    ]
                },
                {
                    name: 'Lịch hoàn thành',
                    data: [
                        {{ $bookingOfWeek['Monday']['completed_bookings'] }},
                        {{ $bookingOfWeek['Tuesday']['completed_bookings'] }},
                        {{ $bookingOfWeek['Wednesday']['completed_bookings'] }},
                        {{ $bookingOfWeek['Thursday']['completed_bookings'] }},
                        {{ $bookingOfWeek['Friday']['completed_bookings'] }},
                        {{ $bookingOfWeek['Saturday']['completed_bookings'] }},
                        {{ $bookingOfWeek['Sunday']['completed_bookings'] }}
                    ]
                },
                {
                    name: 'Lịch đã hủy',
                    data: [
                        {{ $bookingOfWeek['Monday']['cancelled_bookings'] }},
                        {{ $bookingOfWeek['Tuesday']['cancelled_bookings'] }},
                        {{ $bookingOfWeek['Wednesday']['cancelled_bookings'] }},
                        {{ $bookingOfWeek['Thursday']['cancelled_bookings'] }},
                        {{ $bookingOfWeek['Friday']['cancelled_bookings'] }},
                        {{ $bookingOfWeek['Saturday']['cancelled_bookings'] }},
                        {{ $bookingOfWeek['Sunday']['cancelled_bookings'] }}
                    ]
                }
            ];

            var monthData = [{
                    name: 'Lịch đã đặt',
                    data: [
                        {{ $bookingOfMonth['January']['bookings'] }},
                        {{ $bookingOfMonth['February']['bookings'] }},
                        {{ $bookingOfMonth['March']['bookings'] }},
                        {{ $bookingOfMonth['April']['bookings'] }},
                        {{ $bookingOfMonth['May']['bookings'] }},
                        {{ $bookingOfMonth['June']['bookings'] }},
                        {{ $bookingOfMonth['July']['bookings'] }},
                        {{ $bookingOfMonth['August']['bookings'] }},
                        {{ $bookingOfMonth['September']['bookings'] }},
                        {{ $bookingOfMonth['October']['bookings'] }},
                        {{ $bookingOfMonth['November']['bookings'] }},
                        {{ $bookingOfMonth['December']['bookings'] }}
                    ]
                },
                {
                    name: 'Lịch hoàn thành',
                    data: [
                        {{ $bookingOfMonth['January']['completed_bookings'] }},
                        {{ $bookingOfMonth['February']['completed_bookings'] }},
                        {{ $bookingOfMonth['March']['completed_bookings'] }},
                        {{ $bookingOfMonth['April']['completed_bookings'] }},
                        {{ $bookingOfMonth['May']['completed_bookings'] }},
                        {{ $bookingOfMonth['June']['completed_bookings'] }},
                        {{ $bookingOfMonth['July']['completed_bookings'] }},
                        {{ $bookingOfMonth['August']['completed_bookings'] }},
                        {{ $bookingOfMonth['September']['completed_bookings'] }},
                        {{ $bookingOfMonth['October']['completed_bookings'] }},
                        {{ $bookingOfMonth['November']['completed_bookings'] }},
                        {{ $bookingOfMonth['December']['completed_bookings'] }}
                    ]
                },
                {
                    name: 'Lịch đã hủy',
                    data: [
                        {{ $bookingOfMonth['January']['cancelled_bookings'] }},
                        {{ $bookingOfMonth['February']['cancelled_bookings'] }},
                        {{ $bookingOfMonth['March']['cancelled_bookings'] }},
                        {{ $bookingOfMonth['April']['cancelled_bookings'] }},
                        {{ $bookingOfMonth['May']['cancelled_bookings'] }},
                        {{ $bookingOfMonth['June']['cancelled_bookings'] }},
                        {{ $bookingOfMonth['July']['cancelled_bookings'] }},
                        {{ $bookingOfMonth['August']['cancelled_bookings'] }},
                        {{ $bookingOfMonth['September']['cancelled_bookings'] }},
                        {{ $bookingOfMonth['October']['cancelled_bookings'] }},
                        {{ $bookingOfMonth['November']['cancelled_bookings'] }},
                        {{ $bookingOfMonth['December']['cancelled_bookings'] }}
                    ]
                }
            ];

            var dataItem = {
                name: 'Lịch đã đặt',
                data: years.map(function(year) {
                    return bookingOfYear[year]['bookings'];
                })
            };
            yearData.push(dataItem);

            dataItem = {
                name: 'Lịch hoàn thành',
                data: years.map(function(year) {
                    return bookingOfYear[year]['completed_bookings'];
                })
            };
            yearData.push(dataItem);

            dataItem = {
                name: 'Lịch đã hủy',
                data: years.map(function(year) {
                    return bookingOfYear[year]['cancelled_bookings'];
                })
            };
            yearData.push(dataItem);

            var chart = new ApexCharts(document.getElementById("stacked-column-chart"), options);
            chart.render();

            function updateChartData(option) {
                var newData = [];
                var newCategories = [];

                if (option == 'week') {
                    newData = weekData;
                    newCategories = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'];
                } else if (option == 'month') {
                    newData = monthData;
                    newCategories = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7',
                        'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'
                    ];
                } else if (option == 'year') {
                    newData = yearData;
                    newCategories = years;
                }

                chart.updateSeries(newData);
                chart.updateOptions({
                    xaxis: {
                        categories: newCategories
                    }
                });
            }

            var selectOption = document.getElementById("chart-option");
            selectOption.addEventListener("change", function() {
                var selectedOption = selectOption.value;
                updateChartData(selectedOption);
            });

            updateChartData('week');
        });
        $('#revenue-option').change(function () {
        var option = $(this).val(); // Lấy giá trị được chọn
        var baseUrl = window.location.origin;
        var url = baseUrl + '/api/revenue/' + option;
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                var revenueValue = $('#revenue-value');
                var formattedRevenue = formatCurrency(response.revenue);
                revenueValue.text(formattedRevenue);
            }
        });
    });
    function formatCurrency(value) {
        var formatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        });
        return formatter.format(value);
    }
    document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById('pie-chart').getContext('2d');

    var data = {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            data: <?php echo json_encode($data); ?>,
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#00FF00'], 
            hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#00FF00']
        }]
    };

    var options = {
        responsive: true,
        maintainAspectRatio: false
    };

    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options
    });
});
    </script>
@endsection
