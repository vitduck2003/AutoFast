@extends('staff/layout/layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Đây là toàn bộ lịch đã đặt của khách hàng cần bạn xác nhận</h4>
                    <p class="card-title-desc">Chào sếp, nay có rất nhiều lịch cần bạn xác nhận hãy hoàn thành nào.</p>
                    <form method="post" action="{{ route('staff.job.start') }}">
                        @csrf
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Tên khách</th>
                                    <th>Công việc</th>
                                    <th>Giá</th>
                                    <th>Xe</th>
                                    <th>Thời gian xong</th>
                                    <th>Trạng thái</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $job)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="job_ids[]" value="{{ $job->id }}">
                                        </div>
                                    </td>
                                    <td>{{ $job->id }}</td>
                                    <td>{{ $job->name }}</td>
                                    <td>{{ $job->item_name }}</td>
                                    <td>{{ $job->item_price }}</td>
                                    <td>{{ $job->model_car }}</td>
                                    <td>{{ $job->target_time_done }} phút</td>
                                    <td class="text-success">{{ $job->status }}</td>
                                    <td>
                                        @if($job->status == 'Đang chờ nhận việc')
                                            <form method="post" action="{{ route('staff.job.start') }}" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="job_ids[]" value="{{ $job->id }}">
                                                <button type="submit" class="btn btn-primary">Bắt đầu làm</button>
                                            </form>
                                        @endif
                                        @if($job->status == 'Đang làm')
                                              <a href="{{ route('staff.job.done', ['id'=>$job->id]) }}">
                                                <span class="btn btn-success">Hoàn thành</span>
                                            </a>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Bắt đầu làm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
