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
                                <th>ID Booking</th>
                                <th>Tên công việc</th>
                                <th>Thời gian dự kiến</th>
                                <th>Giá</th>
                                <th>Nhân viên phụ trách</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobDetail as $job):
                            <tr>
                                <td>{{ $job->id }}</td>
                                <td>{{ $job->item_name }}</td>
                                <td>{{ $job->target_time_done }}</td>
                                <td>{{ number_format($job->price, 0, ',', '.') }} VND</td>
                                <td>
                                    <select name="" id="">
                                        <option value="">Chọn nhân viên</option>
                                        <option value="1">Nhân viên 1</option>
                                        <option value="2">Nhân viên 2</option>
                                    </select>
                                </td>
                                <td>{{ $job->status }}</td>
                                <td class="text-success">{{ $job->status }}</td> 
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!-- Modal -->
    </div>
@endsection
