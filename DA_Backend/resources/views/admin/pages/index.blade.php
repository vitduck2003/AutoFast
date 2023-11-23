@extends('admin/layout/layout')
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
                            <div class="avatar-md profile-user-wid mb-4">
                                <img src="{{ session('avatar') ? Storage::url(session('avatar')) : '' }}" alt=""
                                    class="img-thumbnail rounded-circle">
                            </div>
                            <h5 class="font-size-15 text-truncate">{{ session('user_name') }}</h5>
                            <p class="text-muted mb-0 text-truncate">Xin chào !</p>
                        </div>

                        <div class="col-sm-8">
                            <div class="pt-4">

                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="font-size-15">125</h5>
                                        <p class="text-muted mb-0">Chưa xác nhận</p>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="font-size-15">$1245</h5>
                                        <p class="text-muted mb-0">Doanh thu</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Doanh thu</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="text-muted">Hôm nay</p>
                            <h3>$34,252</h3>
                            <p class="text-muted"><span class="text-success mr-2"> 12% <i class="mdi mdi-arrow-up"></i>
                                </span> From previous period</p>

                            <div class="mt-4">
                                <a href="" class="btn btn-primary waves-effect waves-light btn-sm">View More <i
                                        class="mdi mdi-arrow-right ml-1"></i></a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mt-4 mt-sm-0">
                                <div id="radialBar-chart" class="apex-charts"></div>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mb-0">We craft digital, graphic and dimensional thinking.</p>
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
                                    <p class="text-muted font-weight-medium">Tông lịch đặt nay</p>
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
                                    <p class="text-muted font-weight-medium">Lịch đã hoàn thành</p>
                                    <h4 class="mb-0">{{ $bookingCompleteToday }}</h4>
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
                                    <p class="text-muted font-weight-medium">Lịch đã hủy</p>
                                    <h4 class="mb-0">{{ $bookingCancelToday }}</h4>
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
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" onclick="updateChartData('week')">Week</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="updateChartData('month')">Month</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="updateChartData('year')">Year</a>
                            </li>
                        </ul>
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
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Social Source</h4>
                    <div class="text-center">
                        <div class="avatar-sm mx-auto mb-4">
                            <span class="avatar-title rounded-circle bg-soft-primary font-size-24">
                                <i class="mdi mdi-facebook text-primary"></i>
                            </span>
                        </div>
                        <p class="font-16 text-muted mb-2"></p>
                        <h5><a href="#" class="text-dark">Facebook - <span class="text-muted font-16">125
                                    sales</span> </a></h5>
                        <p class="text-muted">Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero
                            venenatis faucibus tincidunt.</p>
                        <a href="#" class="text-primary font-16">Learn more <i
                                class="mdi mdi-chevron-right"></i></a>
                    </div>
                    <div class="row mt-4">
                        <div class="col-4">
                            <div class="social-source text-center mt-3">
                                <div class="avatar-xs mx-auto mb-3">
                                    <span class="avatar-title rounded-circle bg-primary font-size-16">
                                        <i class="mdi mdi-facebook text-white"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-15">Facebook</h5>
                                <p class="text-muted mb-0">125 sales</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="social-source text-center mt-3">
                                <div class="avatar-xs mx-auto mb-3">
                                    <span class="avatar-title rounded-circle bg-info font-size-16">
                                        <i class="mdi mdi-twitter text-white"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-15">Twitter</h5>
                                <p class="text-muted mb-0">112 sales</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="social-source text-center mt-3">
                                <div class="avatar-xs mx-auto mb-3">
                                    <span class="avatar-title rounded-circle bg-pink font-size-16">
                                        <i class="mdi mdi-instagram text-white"></i>
                                    </span>
                                </div>
                                <h5 class="font-size-15">Instagram</h5>
                                <p class="text-muted mb-0">104 sales</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Activity</h4>
                    <ul class="verti-timeline list-unstyled">
                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                            </div>
                            <div class="media">
                                <div class="mr-3">
                                    <h5 class="font-size-14">22 Nov <i
                                            class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ml-2"></i>
                                    </h5>
                                </div>
                                <div class="media-body">
                                    <div>
                                        Responded to need “Volunteer Activities
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                            </div>
                            <div class="media">
                                <div class="mr-3">
                                    <h5 class="font-size-14">17 Nov <i
                                            class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ml-2"></i>
                                    </h5>
                                </div>
                                <div class="media-body">
                                    <div>
                                        Everyone realizes why a new common language would be desirable... <a
                                            href="#">Read more</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="event-list active">
                            <div class="event-timeline-dot">
                                <i class="bx bxs-right-arrow-circle font-size-18 bx-fade-right"></i>
                            </div>
                            <div class="media">
                                <div class="mr-3">
                                    <h5 class="font-size-14">15 Nov <i
                                            class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ml-2"></i>
                                    </h5>
                                </div>
                                <div class="media-body">
                                    <div>
                                        Joined the group “Boardsmanship Forum”
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                            </div>
                            <div class="media">
                                <div class="mr-3">
                                    <h5 class="font-size-14">12 Nov <i
                                            class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ml-2"></i>
                                    </h5>
                                </div>
                                <div class="media-body">
                                    <div>
                                        Responded to need “In-Kind Opportunity”
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="text-center mt-4"><a href=""
                            class="btn btn-primary waves-effect waves-light btn-sm">View More <i
                                class="mdi mdi-arrow-right ml-1"></i></a></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Top Cities Selling Product</h4>

                    <div class="text-center">
                        <div class="mb-4">
                            <i class="bx bx-map-pin text-primary display-4"></i>
                        </div>
                        <h3>1,456</h3>
                        <p>San Francisco</p>
                    </div>

                    <div class="table-responsive mt-4">
                        <table class="table table-centered table-nowrap">
                            <tbody>
                                <tr>
                                    <td style="width: 30%">
                                        <p class="mb-0">San Francisco</p>
                                    </td>
                                    <td style="width: 25%">
                                        <h5 class="mb-0">1,456</h5>
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
                                        <p class="mb-0">Los Angeles</p>
                                    </td>
                                    <td>
                                        <h5 class="mb-0">1,123</h5>
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
                                        <p class="mb-0">San Diego</p>
                                    </td>
                                    <td>
                                        <h5 class="mb-0">1,026</h5>
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
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Latest Transaction</h4>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>Order ID</th>
                                    <th>Billing Name</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Payment Status</th>
                                    <th>Payment Method</th>
                                    <th>View Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2540</a>
                                    </td>
                                    <td>Neal Matthews</td>
                                    <td>
                                        07 Oct, 2019
                                    </td>
                                    <td>
                                        $400
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                    </td>
                                    <td>
                                        <i class="fab fa-cc-mastercard mr-1"></i> Mastercard
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button"
                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                            data-toggle="modal" data-target=".exampleModal">
                                            View Details
                                        </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck3">
                                            <label class="custom-control-label" for="customCheck3">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2541</a>
                                    </td>
                                    <td>Jamal Burnett</td>
                                    <td>
                                        07 Oct, 2019
                                    </td>
                                    <td>
                                        $380
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-danger font-size-12">Chargeback</span>
                                    </td>
                                    <td>
                                        <i class="fab fa-cc-visa mr-1"></i> Visa
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button"
                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                            data-toggle="modal" data-target=".exampleModal">
                                            View Details
                                        </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck4">
                                            <label class="custom-control-label" for="customCheck4">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2542</a>
                                    </td>
                                    <td>Juan Mitchell</td>
                                    <td>
                                        06 Oct, 2019
                                    </td>
                                    <td>
                                        $384
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                    </td>
                                    <td>
                                        <i class="fab fa-cc-paypal mr-1"></i> Paypal
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button"
                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                            data-toggle="modal" data-target=".exampleModal">
                                            View Details
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck5">
                                            <label class="custom-control-label" for="customCheck5">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2543</a>
                                    </td>
                                    <td>Barry Dick</td>
                                    <td>
                                        05 Oct, 2019
                                    </td>
                                    <td>
                                        $412
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                    </td>
                                    <td>
                                        <i class="fab fa-cc-mastercard mr-1"></i> Mastercard
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button"
                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                            data-toggle="modal" data-target=".exampleModal">
                                            View Details
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck6">
                                            <label class="custom-control-label" for="customCheck6">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2544</a>
                                    </td>
                                    <td>Ronald Taylor</td>
                                    <td>
                                        04 Oct, 2019
                                    </td>
                                    <td>
                                        $404
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-warning font-size-12">Refund</span>
                                    </td>
                                    <td>
                                        <i class="fab fa-cc-visa mr-1"></i> Visa
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button"
                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                            data-toggle="modal" data-target=".exampleModal">
                                            View Details
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck7">
                                            <label class="custom-control-label" for="customCheck7">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">#SK2545</a>
                                    </td>
                                    <td>Jacob Hunter</td>
                                    <td>
                                        04 Oct, 2019
                                    </td>
                                    <td>
                                        $392
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                    </td>
                                    <td>
                                        <i class="fab fa-cc-paypal mr-1"></i> Paypal
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button"
                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                            data-toggle="modal" data-target=".exampleModal">
                                            View Details
                                        </button>
                                    </td>
                                </tr>
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
    <!-- End Page-content -->
    <!-- Tệp tin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.js"></script>
    <script>
        var options = {
            chart: {
                type: 'bar',
                height: 350,
                stacked: true,
            },
            series: [],
            xaxis: {
                categories: [],
            },
        };
    
        var weekData = [{
                name: 'Lịch đã đặt',
                data: [10, 20, 30, 40, 50, 60, 70]
            },
            {
                name: 'Lịch hoàn thành',
                data: [15, 25, 35, 45, 55, 65, 75]
            },
            {
                name: 'Lịch đã hủy',
                data: [20, 30, 40, 50, 60, 70, 80]
            }
        ];
    
        var monthData = [{
                name: 'Series 1',
                data: [100, 200, 300, 400]
            },
            {
                name: 'Series 2',
                data: [110, 210, 310, 410]
            },
            {
                name: 'Series 3',
                data: [120, 220, 320, 420]
            }
        ];
    
        var yearData = [{
                name: 'Series 1',
                data: [1000, 2000, 3000, 4000, 5000, 6000, 7000, 8000, 9000]
            },
            {
                name: 'Series 2',
                data: [1100, 2100, 3100, 4100, 5100, 6100, 7100, 8100, 9100]
            },
            {
                name: 'Series 3',
                data: [1200, 2200, 3200, 4200, 5200, 6200, 7200, 8200, 9200]
            }
        ];
        var chart = new ApexCharts(document.querySelector("#stacked-column-chart"), options);
            
        // Khởi tạo dữ liệu và tùy chọn cho biểu đồ
        chart.updateSeries(weekData);
        chart.updateOptions({
            xaxis: {
                categories: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật']
            }
        });
    
        chart.render();
    
        function updateChartData(option) {
            var weekData = [{
                name: 'Lịch đã đặt',
                data: [10, 20, 30, 40, 50, 60, 70]
            },
            {
                name: 'Lịch hoàn thành',
                data: [15, 25, 35, 45, 55, 65, 75]
            },
            {
                name: 'Lịch đã hủy',
                data: [20, 30, 40, 50, 60, 70, 80]
            }
        ];

            var newData = [];
            var newCategories = [];
    
            if (option === 'week') {
                newData = weekData;
                newCategories = ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'];
            } else if (option === 'month') {
                newData = monthData;
                newCategories = ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4'];
            } else if (option === 'year') {
                newData = yearData;
                newCategories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'];
            }
            chart.updateSeries(newData);
            chart.updateOptions({
                xaxis: {
                    categories: newCategories
                }
            });
        }
    </script>
@endsection
