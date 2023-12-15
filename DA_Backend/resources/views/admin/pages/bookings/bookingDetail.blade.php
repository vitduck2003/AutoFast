@extends('admin/layout/layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-right font-size-16">Mã lịch #1</h4>
                            <div class="mb-4">
                                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo" height="50px"
                                    width="100px">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <address>
                                    <strong>Thông tin khách hàng</strong><br>
                                    <strong>Họ và tên:</strong><br>
                                    <strong>Số điện thoại</strong><br>
                                    <strong>Email:</strong><br>
                                    <strong>Tên xe:</strong><br>
                                    <strong>Số km đã đi:</strong><br>
                                    <strong>Dịch vụ:</strong><br>
                                </address>
                            </div>
                            <div class="col-sm-6 text-sm-right">
                                <address class="mt-2 mt-sm-0">
                                    <br>
                                    {{ $booking->name }}<br>
                                    {{ $booking->phone }}<br>
                                    {{ $booking->email }}<br>
                                    {{ $booking->model_car }}<br>
                                    {{ $booking->mileage }} Km<br>
                                    {{ $service->service_name }}<br>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mt-3">
                                <address>
                                    <strong>Trạng thái</strong><br>
                                    {{ $booking->status }}
                                </address>
                            </div>
                            <div class="col-sm-6 mt-3 text-sm-right">
                                <address>
                                    <strong>Thời gian đặt</strong><br>
                                    {{ $booking->created_at }}
                                </address>
                            </div>
                        </div>
                        <div class="py-2 mt-3">
                            <h3 class="font-size-15 font-weight-bold">Danh sách dịch vụ</h3>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">ID</th>
                                        <th class="text-center">Tên công việc</th>
                                        <th class="text-center">Giá</th>
                                        @if($booking->status != "Đã hoàn thành")
                                        <th class="text-center">Thao tác</th>
                                        @endIf
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $job)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $job->item_name }} @if ($job->note !== null)
                                            ({{ $job->note }})
                                        @endif
                                        <td class="text-center">{{ number_format($job->item_price, 0, ',', '.') }} VND</td>
                                        @if($booking->status != "Đã hoàn thành")
                                        <td class="text-center">
                                            <a href="{{ route('delete.job.detail.get', ['id'=>$job->id]) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa công việc này?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                     <tr>
                                        <td colspan="2" class="border-0 text-right">
                                            <strong>Tổng tiền</strong>
                                        </td>
                                        <td class="border-0 text-right">
                                            <h4 class="m-0">{{ number_format($total_price->total_price, 0, ',', '.') }} VND</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="py-2 mt-3">
                            <h3 class="font-size-15 font-weight-bold">Lịch sử thay đổi</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Hoạt động</th>
                                        <th>Người thực hiện</th>
                                        <th>Thời gian thực hiện</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $log)
                                    <tr>
                                        <td>{{$log->content}}</td>
                                        <td>{{$log->admin_name}}</td>
                                        <td>{{$log->created_at}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
           @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
@endsection