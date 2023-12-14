@extends('admin/layout/layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-right font-size-16">Hóa đơn #{{ $invoice->id }}</h4>
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
                                    <strong>Trạng thái thanh toán:</strong><br>

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
                                    {{ $invoice->service_name }}<br>
                                    {{ $invoice->status_payment }}<br>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mt-3">
                                <address>
                                    <strong>Kiểu thanh toán</strong><br>
                                    @if ($invoice->method_payment == null)
                                        Chưa thanh toán
                                    @else
                                        {{ $invoice->method_payment }}
                                    @endif
                                </address>
                            </div>
                            <div class="col-sm-6 mt-3 text-sm-right">
                                <address>
                                    <strong>Tạo vào ngày</strong><br>
                                    {{ $invoice->created_at }}<br><br>
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
                                        <th>Tên công việc</th>
                                        <th class="text-right">Giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $job)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $job->item_name }} @if ($job->note !== null)
                                                    ({{ $job->note }})
                                                @endif
                                            </td>
                                            <td class="text-right">{{ number_format($job->item_price, 0, ',', '.') }} VNĐ
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-right">Giảm giá</td>
                                        <td class="text-right"><h5>{{ number_format($invoice->total_discount) }} VNĐ<h5></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="border-0 text-right">
                                            <strong>Tổng tiền</strong>
                                        </td>
                                        <td class="border-0 text-right">
                                            <h4 class="m-0">{{ number_format($invoice->total_amount, 0, ',', '.') }}VNĐ
                                            </h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-print-none mt-4">
                            <div class="float-right">
                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-2"><i
                                            class="fa fa-print"></i> In Hóa đơn</a>
                                   <a href="{{ route('detail.invoicemail', $invoice->id) }}" class="btn btn-primary waves-effect waves-light mr-2">Gửi qua Email</a>
                                  @if ($invoice->status_payment == 'Chưa thanh toán')
                                    <a href="{{ route('status.payment', ['id' => $invoice->id]) }}"
                                        class="btn btn-success waves-effect waves-light">Đã thanh toán</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
