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
                            @foreach($bookings as $booking)
                            <tr>      
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->name }}</td>
                                <td>{{ $booking->phone }}</td>
                                <td>{{ $booking->model_car }}</td>
                                <td>{{ $booking->mileage }}Km</td>
                                <td>{{ $booking->target_date }}: {{ $booking->target_time }}</td>
                                <td class="text-danger">{{ $booking->status }}</td>
                                <td>
                                    <form action="{{ route('booking.confirm', ['id' => $booking->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-success" onclick="return confirm('Bạn có muốn xác nhận lịch không?')">Xác nhận</button>
                                    </form>
                                    <form action="{{ route('booking.revoke', ['id' => $booking->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-warning" onclick="return confirm('Bạn có muốn hủy lịch không?')">Hủy</button>
                                    </form>
                                  
                                        <a href="{{ route('booking.edit.view', ['id'=>$booking->id]) }}">
                                            <button type="submit" class="btn btn-primary text-center">Sửa</button>
                                        </a>

                                    <a href="{{ route('booking.detail', ['id'=> $booking->id]) }}">
                                        <button type="button" class="btn btn-info">
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
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <p><strong>Tổng tiền:</strong> <span id="total_prices"></span></p>
                <p><strong>Ngày giờ đến:</strong> <span id="target_date"></span></p>
                <p><strong>Ghi chú:</strong> <span id="note"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div> --}}
    </div>
@section('script')
<!-- Thư viện jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-Ds0X1ls0BU+X+gX3sVY7qclY4mBeO8z9qL6ahxRc0QY2yYJ5TQI1vzN0LYW8X0Hh" crossorigin="anonymous"></script>
<!-- Thư viện Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha384-k9o4f/+cB8C0QV6eAlM7i0V0jKj+3tB4XqDyq5djBv8w/3eWt0YJ/6WfqK0IeFVy" crossorigin="anonymous"></script>
<script>
    // $(document).ready(function () {
    //     $('#exampleModal').on('show.bs.modal', function (event) {
    //         var button = $(event.relatedTarget); // Nút "Chi tiết" được nhấp
    //         var bookingId = button.data('booking-id'); // Lấy giá trị booking ID từ thuộc tính data-booking-id
    //         // Tạo yêu cầu GET tới API để lấy dữ liệu booking từ server
    //         $.get('/api/bookings/' + bookingId, function (data) {
    //             // Thiết lập dữ liệu booking vào modal
    //             var modal = $('#exampleModal');
    //             modal.find('.modal-title').text('Chi tiết đặt lịch');
    //             // Đổ dữ liệu booking vào các phần tử trong modal
    //             modal.find('#name').text(data[0].name);
    //             modal.find('#phone').text(data[0].phone);
    //             modal.find('#email').text(data[0].email);
    //             modal.find('#model_car').text(data[0].model_car);
    //             modal.find('#mileage').text(data[0].mileage + ' Km');
    //             modal.find('#service').text(data[0].service_name);
    //             modal.find('#tasks').text(data[0].item_names);
    //             modal.find('#prices').text(data[0].item_prices + ' VNĐ');
    //             modal.find('#total_prices').text(data[0].total_prices + ' VNĐ');
    //             modal.find('#target_date').text(data[0].target_date + ': ' + data[0].target_time);
    //             modal.find('#note').text(data[0].note);

    //             // Update the data-booking-id attribute for Confirm and Cancel buttons
    //             modal.find('.btn-confirm').attr('data-booking-id', bookingId);
    //             modal.find('.btn-cancel').attr('data-booking-id', bookingId);
    //         })
    //             .fail(function (error) {
    //                 console.log('Lỗi khi gửi yêu cầu API:', error);
    //             });
    //     });
    // });
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
@endsection
