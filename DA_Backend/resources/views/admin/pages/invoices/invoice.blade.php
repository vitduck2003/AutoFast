@extends('admin/layout/layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Đây là toàn bộ lịch đã đặt của khách hàng cần bạn xác nhận</h4>
                    <p class="card-title-desc">Chào sếp, nay có rất nhiều lịch cần bạn xác nhận hãy hoàn thành nào.</p>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>ID Bill</th>
                                <th>Tên khách hàng</th>
                                <th>Tên xe</th>
                                <th>Công việc</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái thanh toán</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bills as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->model_car }}</td>
                                <td>{{ $item->service_name }}</td>
                                <td>{{ $item->total_amount}}</td>                        
                                <td class="text-success">{{ $item->status_payment }}</td>
                                <td>
                                    <a href="{{ route('detail.invoice', ['id' => $item->id]) }}">
                                        <button type="submit" class="btn btn-success">Chi tiết</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    </div>
@endsection
