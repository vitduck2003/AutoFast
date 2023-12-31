@extends('staff/layout/layout')
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
                                <th>ID</th>
                                <th>Tên khách</th>
                                <th>Công việc</th>
                                <th>Giá</th>
                                <th>Xe</th>
                                <th>Thời gian xong</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                            <tr>
                                <td>{{ $job->id }}</td>
                                <td>{{ $job->name }}</td>
                                <td>{{ $job->item_name }}</td>
                                <td>{{ $job->item_price }}</td>
                                <td>{{ $job->model_car }}</td>
                                <td>{{ $job->created_at ? $job->created_at : $job->target_time_done." phút"}}</td>
                                <td class="text-success">{{ $job->status }}</td>
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
