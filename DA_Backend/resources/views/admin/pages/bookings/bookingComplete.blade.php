@extends('admin/layout/layout')
@section('content')
{{-- @if (Session::has('success'))
    <div class="alert alert-success">
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif --}}
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
                                @if($booking->status_bill == "Chưa tạo hóa đơn")
                                <td class="text-danger">{{ $booking->status_bill }}</td>
                                @endif
                                @if($booking->status_bill == "Đã tạo hóa đơn")
                                <td class="text-success">{{ $booking->status_bill }}</td>
                                @endif
                                <td>
                                   @if($booking->status_bill == "Chưa tạo hóa đơn")
                                  
                                   <form action="{{ route('create.invoice') }}" method="POST" style="display: inline;">
                                    @csrf
                                    
                                    <input type="text" name="total_amount" hidden value="{{ $booking->total_prices }}">
                                    <input type="text" name="id_booking" hidden value="{{ $booking->id }}">
                                     <input type="text" name="total_discount" hidden value="{{ $booking->total_discount }}">
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn có muốn tạo hóa đơn không?')">Tạo hóa đơn</button>
                                </form>
                                   @endif
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
    </div>
@section('script')
<!-- Thư viện jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-Ds0X1ls0BU+X+gX3sVY7qclY4mBeO8z9qL6ahxRc0QY2yYJ5TQI1vzN0LYW8X0Hh" crossorigin="anonymous"></script>
<!-- Thư viện Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha384-k9o4f/+cB8C0QV6eAlM7i0V0jKj+3tB4XqDyq5djBv8w/3eWt0YJ/6WfqK0IeFVy" crossorigin="anonymous"></script>

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
</script>
@endsection
@endsection
