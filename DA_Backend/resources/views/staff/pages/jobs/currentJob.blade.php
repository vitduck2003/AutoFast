@extends('staff/layout/layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Đây là toàn bộ lịch đã đặt của khách hàng cần bạn xác nhận</h4>
                    <p class="card-title-desc">Chào sếp, nay có rất nhiều lịch cần bạn xác nhận hãy hoàn thành nào.</p>
                    <form method="post" action="{{ route('staff.job.action') }}">
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
                                            <form method="post" action="{{ route('staff.job.action') }}" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="job_ids[]" value="{{ $job->id }}">
                                                <button type="submit" value="start" name="action" class="btn btn-primary">Bắt đầu làm</button>
                                            </form>
                                        @endif
                                        @if($job->status == 'Đang làm')
                                        <form method="post" action="{{ route('staff.job.action') }}" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="job_ids[]" value="{{ $job->id }}">
                                            <button type="submit" value="done" name="action" class="btn btn-success">Hoàn thành</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center mt-3">
                            <button name="action" value="start" type="submit" class="btn btn-primary">Bắt đầu làm</button>
                            <button id="completeAllButton" name="action" value="done" type="submit" class="btn btn-success">Hoàn thành</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
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
        document.addEventListener('DOMContentLoaded', function() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            var completeAllButton = document.getElementById('completeAllButton');
    
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
                    var disableCompleteAllButton = false;
    
                    checkedCheckboxes.forEach(function(checkedCheckbox) {
                        var status = checkedCheckbox.closest('tr').querySelector('.text-success').textContent.trim();
    
                        if (status === 'Đang chờ nhận việc') {
                            disableCompleteAllButton = true;
                        }
                    });
    
                    completeAllButton.disabled = disableCompleteAllButton;
                });
            });
        });
    </script>
@endsection
