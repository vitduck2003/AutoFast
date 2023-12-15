@extends('admin/layout/layout')

@section('content')
    <form action="{{ route('booking.edit') }}" method="POST">
        <div class="container">
            <h3>Sửa lịch bảo dưỡng</h3>
            <input hidden name="id_booking" type="text" value="{{ $booking->id }}">
            <div class="form-group">
                <label for="full_name">Họ tên:</label>
                <input value="{{ $booking->name }}" type="text" name="name" class="form-control" id="name"
                    placeholder="Nhập họ tên">
                @error('name')
                <div class="alert alert-danger">Vui lòng không để trống họ tên</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" class="form-control" name="phone" value="{{ $booking->phone }}" id="phone"
                    placeholder="Nhập số điện thoại">
                @error('phone')
                <div class="alert alert-danger">Vui lòng không để trống SĐT</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="{{ $booking->email }}" id="email"
                    placeholder="Nhập địa chỉ email">
                @error('email')
                <div class="alert alert-danger">Vui lòng không để trống email</div>
                @enderror
            </div>

            <div class="form-group">
                <label  for="car_type">Loại xe:</label>
                <select class="form-control" id="car_type" name="model_car">
                    <option disabled>Lựa chọn loại xe của bạn</option>
                    <option value="Sedan" <?php echo $booking->model_car == 'Sedan' ? 'selected' : ''; ?>>Sedan</option>
                    <option value="HatchBack" <?php echo $booking->model_car == 'HatchBack' ? 'selected' : ''; ?>>HatchBack</option>
                    <option value="SUV" <?php echo $booking->model_car == 'SUV' ? 'selected' : ''; ?>>SUV</option>
                    <option value="Crossover" <?php echo $booking->model_car == 'Crossover' ? 'selected' : ''; ?>>Crossover (CUV)</option>
                    <option value="MPV" <?php echo $booking->model_car == 'MPV' ? 'selected' : ''; ?>>MPV</option>
                    <option value="Coupe" <?php echo $booking->model_car == 'Coupe' ? 'selected' : ''; ?>>Coupe</option>
                    <option value="Convertible" <?php echo $booking->model_car == 'Convertible' ? 'selected' : ''; ?>>Convertible</option>
                    <option value="Pickup" <?php echo $booking->model_car == 'Pickup' ? 'selected' : ''; ?>>Pickup</option>
                    <option value="Limousine" <?php echo $booking->model_car == 'Limousine' ? 'selected' : ''; ?>>Limousine</option>
                </select>
            </div>
            <div class="form-group">
                <label for="arrival_time">Thời gian đến:</label>
                <select class="form-control" name="target_time">
                    <option value="08:00:00" {{ $booking->target_time === '08:00:00' ? 'selected' : '' }}>8:00</option>
                    <option value="10:00:00" {{ $booking->target_time === '10:00:00' ? 'selected' : '' }}>10:00</option>
                    <option value="13:00:00" {{ $booking->target_time === '13:00:00' ? 'selected' : '' }}>13:00</option>
                    <option value="15:00:00" {{ $booking->target_time === '15:00:00' ? 'selected' : '' }}>15:00</option>
                    <option value="17:00:00" {{ $booking->target_time === '17:00:00' ? 'selected' : '' }}>17:00</option>
                </select>
                
            </div>

            <div class="form-group">
                <label for="arrival_date">Ngày đến:</label>
                <input type="date" value="{{ $booking->target_date }}" class="form-control" id="arrival_date"
                    name="target_date">
                    @error('target_time')
                    <div class="alert alert-danger">Không để chọn ngày hôm qua</div>
                    @enderror
            </div>

            <div class="form-group">
                <label for="mileage">Số km đã chạy:</label>
                <input type="number" name="mileage" value="{{ $booking->mileage }}" min="0" class="form-control"
                    id="mileage" placeholder="Nhập số km đã chạy">
                @error('mileage')
                <div class="alert alert-danger">Vui lòng không để trống km</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="other_service">Dịch vụ:</label> <br>
                <select class="form-control" name="service" id="other_service">
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}"
                            {{ (!empty($service_present) && $service_present->id== $service->id) ? 'selected' : '' }}>
                            {{ $service->service_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="service_type">Dịch vụ khác:</label><br>
                <div class="form-check">
                    @foreach ($service_items_other as $item)
                        <?php $isChecked = $service_items_other_present->contains('item_name', $item->item_name); ?>
                        <input type="checkbox" name="service_other[]" id="service_type{{ $item->id }}"
                            value="{{ $item->id }}" class="form-check-input" {{ $isChecked ? 'checked' : '' }}>
                        <label for="service_type{{ $item->id }}" class="form-check-label">{{ $item->item_name }}</label><br>
                    @endforeach
                    <input type="hidden" name="service_other[]" value="">
                </div>
            </div>
            @csrf
            <button type="submit" class="btn btn-primary">Gửi</button>
        </div>
    </form>
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
        </script>
        @endsection
@endsection