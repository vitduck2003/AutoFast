@extends('admin/layout/layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-right font-size-16">Hóa đơn # 12345</h4>
                        <div class="mb-4">
                            <img src="{{ asset('assets\images\logo-dark.png') }}" alt="logo" height="20">
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
                            </address>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <address class="mt-2 mt-sm-0">
                            <br>
                                {{ $invoice->name }}<br>
                                {{ $invoice->phone }}<br>
                                {{ $invoice->email }}<br>
                                {{ $invoice->model_car }}<br>
                                {{ $invoice->mileage }} Km<br>
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mt-3">
                            <address>
                                <strong>Kiểu thanh toán</strong><br>
                                Visa ending **** 4242<br>
                                jsmith@email.com
                            </address>
                        </div>
                        <div class="col-sm-6 mt-3 text-sm-right">
                            <address>
                                <strong>Tạo vào ngày</strong><br>
                                {{ $invoice->name }}<br><br>
                            </address>
                        </div>
                    </div>
                    <div class="py-2 mt-3">
                        <h3 class="font-size-15 font-weight-bold">Tất cả các dịch vụ</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 70px;">ID</th>
                                    <th>Tên công việc</th>
                                    <th class="text-right">Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $job->item_name }}</td>
                                    <td class="text-right">{{ number_format($job->item_price, 0, ',', '.') }} VND</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="2" class="text-right">Sub Total</td>
                                    <td class="text-right">0</td>
                                </tr>
                                <tr>
                                    {{-- <td colspan="2" class="border-0 text-right">
                                        <strong>Shipping</strong></td>
                                    <td class="border-0 text-right">$13.00</td> --}}
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-right">
                                        <strong>Total</strong></td>
                                    <td class="border-0 text-right"><h4 class="m-0">{{ number_format($invoice->total_amount, 0, ',', '.') }}VNĐ</h4></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-print-none">
                        <div class="float-right">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                            <a href="#" class="btn btn-primary w-md waves-effect waves-light">Send</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection