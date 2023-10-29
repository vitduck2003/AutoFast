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
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Loại xe</th>
                                <th>Số KM</th>
                                <th>Ngày giờ đến</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job):
                            <tr>
                                <td>{{ $job->id }}</td>
                                <td>{{ $job->name }}</td>
                                <td>{{ $job->phone }}</td>
                                <td>{{ $job->model_car }}</td>
                                <td>{{ $job->mileage }}Km</td>
                                <td>{{ $job->target_date }}: {{ $job->target_time }}</td>
                                <td class="text-success">{{ $job->status }}</td>
                                <td>
                                    <a href="{{ url('admin/job-detail', ['id'=>$job->id]) }}">
                                        <button type="button" class="btn btn-success">
                                            Xem công việc
                                        </button>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết đặt lịch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Nội dung chi tiết đặt lịch sẽ được đổ vào đây -->
                <p><strong>Họ tên:</strong> <span id="name"></span></p>
                <p><strong>Số điện thoại:</strong> <span id="phone"></span></p>
                <p><strong>Email:</strong> <span id="email"></span></p>
                <p><strong>Loại xe:</strong> <span id="model_car"></span></p>
                <p><strong>Số KM:</strong> <span id="mileage"></span></p>
                <p><strong>Công việc:</strong> <span id="tasks"></span></p>
                <p><strong>Giá tiền:</strong> <span id="prices"></span></p>
                <p><strong>Ngày giờ đến:</strong> <span id="target_date"></span></p>
                <p><strong>Ghi chú:</strong> <span id="note"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
    </div>
@section('script')
<script>
    $(document).ready(function () {
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Nút "Chi tiết" được nhấp
            var bookingId = button.data('booking-id'); // Lấy giá trị booking ID từ thuộc tính data-booking-id

            // Tạo yêu cầu GET tới API để lấy dữ liệu booking từ server
            $.get('/api/bookings/' + bookingId, function (data) {
                // Thiết lập dữ liệu booking vào modal
                var modal = $('#exampleModal');
                modal.find('.modal-title').text('Chi tiết đặt lịch');
                // Đổ dữ liệu booking vào các phần tử trong modal
                modal.find('#name').text(data[0].name);
                modal.find('#phone').text(data[0].phone);
                modal.find('#email').text(data[0].email);
                modal.find('#model_car').text(data[0].model_car);
                modal.find('#mileage').text(data[0].mileage + ' Km');
                modal.find('#tasks').text(data[0].item_names);
                modal.find('#prices').text(data[0].item_prices + ' VNĐ');
                modal.find('#target_date').text(data[0].target_date + ': ' + data[0].target_time);
                modal.find('#note').text(data[0].note);

                // Update the data-booking-id attribute for Confirm and Cancel buttons
                modal.find('.btn-confirm').attr('data-booking-id', bookingId);
                modal.find('.btn-cancel').attr('data-booking-id', bookingId);
            })
                .fail(function (error) {
                    console.log('Lỗi khi gửi yêu cầu API:', error);
                });
        });

        // Handle Confirm button click
        $('#btn-confirm').on('click', function () {
            var bookingId = $(this).data('booking-id');
            // Tạo yêu cầu PUT tới API để cập nhật trạng thái booking
            $.ajax({
                url: '/api/bookings/' + bookingId + '/update-status',
                type: 'PUT',
                data: { status: 'Đã xác nhận' },
                success: function (response) {
                    console.log('Xác nhận thành công:', response);
                    // Close the modal or update UI as needed
                },
                error: function (error) {
                    console.log('Lỗi khi xác nhận:', error);
                }
            });
        });

        // Handle Cancel button click
        $('#btn-cancel').on('click', function () {
            var bookingId = $(this).data('booking-id');

            // Tạo yêu cầu PUT tới API để cập nhật trạng thái booking
            $.ajax({
                url: '/api/bookings/' + bookingId + '/update-status',
                type: 'PUT',
                data: { status: 'Đã được hủy' },
                success: function (response) {
                    console.log('Hủy thành công:', response);
                    // Close the modal or update UI as needed
                },
                error: function (error) {
                    console.log('Lỗi khi hủy:', error);
                }
            });
        });
    });
</script>

@endsection
@endsection
