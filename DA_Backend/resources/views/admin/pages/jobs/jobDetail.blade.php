@extends('admin/layout/layout')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Đây là toàn bộ lịch đã đặt của khách hàng cần bạn xác nhận</h4>
                <p class="card-title-desc">Chào sếp, nay có rất nhiều lịch cần bạn xác nhận hãy hoàn thành nào.</p>
                <a href="{{ route('view.add.job', ['id' => $idBooking]) }}">
                    <button type="button" class="btn btn-success">Thêm công việc</button>
                </a>
                <form action="{{ route('save.staff') }}" method="POST">
                    @csrf
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th></th> <!-- Checkbox column -->
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
                            @foreach ($jobDetail as $index => $job)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="job_id[{{ $job->id }}]"
                                            value="{{ $job->id }}">
                                    </td>
                                    <td>{{ $job->id }}</td>
                                    <td>{{ $job->item_name }}</td>
                                    <td>{{ $job->target_time_done }}</td>
                                    <td>{{ number_format($job->price, 0, ',', '.') }} VND</td>
                                    <td>
                                        <select name="staff_id[{{ $job->id }}]">
                                            <option value="">Chọn nhân viên</option>
                                            @foreach ($staffs_free_time as $staff)
                                                <option value="{{ $staff->id }}"
                                                    {{ $staff->id == $job->id_staff ? 'selected' : '' }}>
                                                    {{ $staff->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    @if ($job->status == 'Chưa phân công việc')
                                        <td class="text-danger">{{ $job->status }}</td>
                                    @elseif ($job->status == 'Đang chờ nhận việc')
                                        <td class="text-danger">{{ $job->status }}</td>
                                    @elseif ($job->status == 'Đang làm')
                                        <td class="text-danger">{{ $job->status }}</td>
                                    @elseif ($job->status == 'Đã hoàn thành')
                                        <td class="text-success">{{ $job->status }}</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('delete.job.detail', ['id' => $job->id]) }}">
                                            <button type="button" class="btn btn-danger">Xóa</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" id="check-all-btn">Chọn tất cả</button>
                        <button type="button" class="btn btn-primary" id="uncheck-all-btn">Bỏ chọn tất cả</button>
                        <button type="submit" class="btn btn-primary" id="save-all-btn">Lưu tất cả</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<script>
    document.getElementById('check-all-btn').addEventListener('click', function() {
        var checkboxes = document.querySelectorAll('#datatable tbody tr input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = true;
        });
    });
    document.getElementById('uncheck-all-btn').addEventListener('click', function() {
    var checkboxes = document.querySelectorAll('#datatable tbody tr input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
    });
});
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