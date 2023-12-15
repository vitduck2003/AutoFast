@extends('admin/layout/layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Đây là toàn bộ lịch đã đặt của khách hàng đang chờ đến</h4>
                    <p class="card-title-desc">Chào sếp, nay có rất nhiều lịch đang chờ khách đến.</p>

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
                                        @if ($checkRoom < 1 || $checkStaff < 1)
                                            <form action="{{ route('booking.priority', ['id' => $booking->id]) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('POST')
                                                <input type="text" hidden name="idBooking" value="{{ $booking->id }}">
                                                <button type="submit" class="btn btn-warning"
                                                    onclick="return confirm('Bạn có muốn chuyển sang ưu tiên?')">Chuyển ưu
                                                    tiên</button>
                                            </form>
                                        @endIf
                                        <button type="button" class="btn btn-primary"
                                            onclick="openStartJobModal({{ $booking->id }})">Bắt đầu làm
                                        </button>
                                        <form action="{{ route('booking.revoke', ['id' => $booking->id]) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Bạn có muốn hủy lịch không?')">Hủy</button>
                                        </form>
                                        <a href="{{ route('booking.detail', ['id'=> $booking->id]) }}">
                                            <button type="button" class="btn btn-success">
                                                Chi tiết
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
                          @if($checkStaff < 1)
                          <p class="text-danger mt-2">Tất cả nhân viên đã bận, hãy chuyển sang ưu tiên</p>
                          @endif
                            <span id="staffError" class="text-danger">
                        </div>
                        <div class="form-group">
                            <label for="roomSelect">Chọn phòng:</label>
                            <select class="form-control" id="roomSelect" name="room">
                                <option value="">-- Chọn phòng --</option>
                            </select>
                            @if($checkRoom < 1)
                            <p class="text-danger mt-2">Tất cả phòng đã bận, hãy chuyển sang ưu tiên</p>
                            @endif
                            <span id="roomError" class="text-danger">
                        </div>
                        @csrf
                       @if($checkBookingPrio > 0 )
                       <p class="text-danger mt-2">Hiện đang có {{ $checkBookingPrio }} lịch cần ưu tiên, vui lòng làm trước</p>
                       @endif
                        <button type="submit" class="btn btn-primary">Bắt đầu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@section('script')
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
        var checkRoom = true;
        var checkStaff = true;
        $(document).ready(function() {
            $.get('/api/staff', function(staffs) {
                if(staffs == null){
                    var checkStaff = false;
                }
                var staffSelect = $('#staffSelect');
                $.each(staffs, function(index, staff) {
                    staffSelect.append('<option value="' + staff.id + '">' + staff.name +
                        '</option>');
                });
            });
            $.get('/api/room', function(rooms) {
                if(rooms == null){
                    var checkRoom = false;
                }
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
                    url: '{{ route('booking.startJob') }}',
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
