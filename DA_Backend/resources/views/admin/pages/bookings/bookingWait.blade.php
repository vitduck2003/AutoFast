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
                                <th class="text-center">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                :
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->name }}</td>
                                    <td>{{ $booking->phone }}</td>
                                    <td>{{ $booking->model_car }}</td>
                                    <td>{{ $booking->mileage }}Km</td>
                                    <td>{{ $booking->target_date }}: {{ $booking->target_time }}</td>
                                    <td class="text-danger">{{ $booking->status }}</td>
                                    <td>
                                       @if($checkRoom < 1 || $checkStaff < 1)
                                       <form action="{{ route('booking.priority', ['id' => $booking->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('POST')
                                        <input type="text" hidden name="idBooking" value="{{ $booking->id }}" >
                                        <button type="submit" class="btn btn-warning" onclick="return confirm('Bạn có muốn chuyển sang ưu tiên?')">Chuyển ưu tiên</button>
                                    </form>
                                       @endIf
                                        <button type="button" class="btn btn-primary"
                                            onclick="openStartJobModal({{ $booking->id }})">Bắt đầu làm
                                        </button>
                                        <form action="{{ route('booking.revoke', ['id' => $booking->id]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn hủy lịch không?')">Hủy</button>
                                        </form>
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#exampleModal" data-booking-id="{{ $booking->id }}">
                                            Chi tiết
                                        </button>
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
                    <p><strong>Dịch vụ:</strong> <span id="service"></span></p>
                    <p><strong>Công việc:</strong> <span id="tasks"></span></p>
                    <p><strong>Ngày giờ đến:</strong> <span id="target_date"></span></p>
                    <p><strong>Ghi chú:</strong> <span id="note"></span></p>
                    <p><strong>Người xác nhận:</strong> <span id="admin_name"></span></p>
                    <p><strong>Thời gian xác nhận:</strong> <span id="confirmed_at"></span></p>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="startJobModal" tabindex="-1" role="dialog" aria-labelledby="startJobModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="startJobModalLabel">Bắt đầu làm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('booking.startJob') }}" id="startJobForm" method="POST">
                        <div class="form-group">
                            <label for="staffSelect">Chọn nhân viên:</label>
                            <select class="form-control" id="staffSelect" name="staff">
                                <option value="">-- Chọn nhân viên --</option>
                            </select>   
                            <span id="staffError" class="text-danger">
                        </div>
                        <div class="form-group">
                            <label for="roomSelect">Chọn phòng:</label>
                            <select class="form-control" id="roomSelect" name="room">
                                <option value="">-- Chọn phòng --</option>
                            </select>
                            <span id="roomError" class="text-danger">
                        </div>
                        @csrf 
                        <button type="submit" class="btn btn-primary">Bắt đầu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@section('script')
    <script>
        $(document).ready(function() {
            $('#exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); 
                var bookingId = button.data('booking-id'); 
                $.get('/api/bookings-wait/' + bookingId, function(data) {
        
                        var modal = $('#exampleModal');
                        modal.find('.modal-title').text('Chi tiết đặt lịch');
                        modal.find('#name').text(data[0].name);
                        modal.find('#phone').text(data[0].phone);
                        modal.find('#email').text(data[0].email);
                        modal.find('#model_car').text(data[0].model_car);
                        modal.find('#mileage').text(data[0].mileage + ' Km');
                        modal.find('#service').text(data[0].service_name);
                        modal.find('#tasks').text(data[0].item_names);
                        modal.find('#prices').text(data[0].item_prices + ' VNĐ');
                        modal.find('#target_date').text(data[0].target_date + ': ' + data[0] .target_time);
                        modal.find('#note').text(data[0].note);
                        modal.find('#admin_name').text(data[0].logs[0].admin_name);
                        modal.find('#confirmed_at').text(data[0].logs[0].confirmed_at);
                        modal.find('.btn-confirm').attr('data-booking-id', bookingId);
                        modal.find('.btn-cancel').attr('data-booking-id', bookingId);
                    })
                    .fail(function(error) {
                        console.log('Lỗi khi gửi yêu cầu API:', error);
                    });
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
        $(document).ready(function() {
            $.get('/api/staff', function(staffs) {
                var staffSelect = $('#staffSelect');
                $.each(staffs, function(index, staff) {
                    staffSelect.append('<option value="' + staff.id + '">' + staff.name +
                        '</option>');
                });
            });
            $.get('/api/room', function(rooms) {
                var roomSelect = $('#roomSelect');
                $.each(rooms, function(index, room) {
                    roomSelect.append('<option value="' + room.id + '">' + room.name + '</option>');
                });
            });
        });

        function openStartJobModal(bookingId) {
            $('#startJobModal').attr('data-booking-id', bookingId);
            $('#startJobModal').modal('show');
        }
        $('#startJobForm').submit(function(e) {
    e.preventDefault();

    var selectedStaff = $('#staffSelect').val();
    var selectedRoom = $('#roomSelect').val();

    // Xóa thông báo lỗi cũ
    $('#staffError').text('');
    $('#roomError').text('');

    var isValid = true;

    if (selectedStaff === '') {
        $('#staffError').text('Vui lòng chọn nhân viên');
        isValid = false;
    }

    if (selectedRoom === '') {
        $('#roomError').text('Vui lòng chọn phòng làm việc');
        isValid = false;
    }

    if (isValid) {
        var bookingId = $('#startJobModal').data('booking-id');
        var staffId = $('#staffSelect').val();
        var roomId = $('#roomSelect').val();

        $('#startJobModal').modal('hide');

        $.ajax({
            type: 'POST',
            url: '{{ route("booking.startJob") }}',
            data: {
                _token: '{{ csrf_token() }}',
                bookingId: bookingId,
                staffId: staffId,
                room: roomId,
            },
            success: function() {
                location.reload();
            },
            error: function(error) {
                console.log('Lỗi khi gửi yêu cầu API:', error);
            }
        });
    }
});
    </script>
@endsection
@endsection
