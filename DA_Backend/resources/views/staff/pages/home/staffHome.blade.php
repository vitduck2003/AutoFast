@extends('staff/layout/layout')
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
                                <p>Thống kê nhân viên</p>
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
                                        <p class="text-muted mb-0">Chờ nhận việc</p>
                                        <h5 class="font-size-15">{{ $waitingJobs }}</h5>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-muted mb-0">Đã hoàn thành</p>
                                        <h5 class="font-size-15">{{ $completeJobs }}</h5>
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
                                    <p class="text-muted font-weight-medium">Đang chờ nhận việc</p>
                                    <h4 class="mb-0">{{ $waitingJobs }}</h4>
                                </div>

                                <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-calendar-plus font-size-24"></i>
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
                                    <p class="text-muted font-weight-medium">Công việc đang làm</p>
                                    <h4 class="mb-0">{{ $doingJobs }}</h4>
                                </div>

                                <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                    <span class="avatar-title rounded-circle bg-primary">
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
                                    <p class="text-muted font-weight-medium">Công việc hoàn thành</p>
                                    <h4 class="mb-0">{{ $completeJobs }}</h4>
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
            </div>
            <!-- end row -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4 float-sm-left">Thống kê các công việc đã hoản thành</h4>
                    <div class="float-sm-right">
                        <select id="chart-option">
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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Đơn đặt lịch gần đây</h4>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên khách</th>
                                    <th>Ngày tạo</th>
                                    <th>Trang thái </th>
                                    <th>Cầu</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($bookings as $bk)
                                    <tr>
                                    <td><a href="javascript: void(0);" class="text-body font-weight-bold">{{ $bk->id }}</a>
                                    </td>
                                    <td>{{ $bk->name }}</td>
                                    <td>
                                        {{$bk->created_at}}
                                    </td>
                                    <td>
                                        {{$bk->status}}
                                    </td>
                                    <td>
                                    {{$bk->room_name}}
                                    </td>
                                    <td>
                                    <a href="{{ route('booking.detail', ['id'=> $bk->id]) }}"><button type="button"
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
    <!-- end row -->

    </div>
    <!-- container-fluid -->
    </div>
    <script>
        var wordOfYear = {!! json_encode($wordOfYear) !!};
        var years = Object.keys(wordOfYear);
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

            var weekData = [
                {
                    name: 'Đã hoàn thành',
                    data: [
                        {{ $wordOfWeek['Monday']['completed_words'] }},
                        {{ $wordOfWeek['Tuesday']['completed_words'] }},
                        {{ $wordOfWeek['Wednesday']['completed_words'] }},
                        {{ $wordOfWeek['Thursday']['completed_words'] }},
                        {{ $wordOfWeek['Friday']['completed_words'] }},
                        {{ $wordOfWeek['Saturday']['completed_words'] }},
                        {{ $wordOfWeek['Sunday']['completed_words'] }}
                    ]
                }
            ];

            var monthData = [
                {
                    name: 'Đã hoàn thành',
                    data: [
                        {{ $wordOfMonth['January']['completed_words'] }},
                        {{ $wordOfMonth['February']['completed_words'] }},
                        {{ $wordOfMonth['March']['completed_words'] }},
                        {{ $wordOfMonth['April']['completed_words'] }},
                        {{ $wordOfMonth['May']['completed_words'] }},
                        {{ $wordOfMonth['June']['completed_words'] }},
                        {{ $wordOfMonth['July']['completed_words'] }},
                        {{ $wordOfMonth['August']['completed_words'] }},
                        {{ $wordOfMonth['September']['completed_words'] }},
                        {{ $wordOfMonth['October']['completed_words'] }},
                        {{ $wordOfMonth['November']['completed_words'] }},
                        {{ $wordOfMonth['December']['completed_words'] }}
                    ]
                }
            ];

            var dataItem = {
                name: 'Đã hoàn thành',
                data: years.map(function(year) {
                    return wordOfYear[year]['completed_words'];
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
            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], 
            hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
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
