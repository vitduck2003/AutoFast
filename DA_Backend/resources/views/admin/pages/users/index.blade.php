@extends('admin.layout.layout')
@section('title', 'Danh sách tài khoản')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Họ và Tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Vai trò</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td> {{$user->name}} </td>
                            <td> {{$user->email}} </td>
                            <td> {{$user->phone}} </td>
                            <td> @if($user->address == '')
                                Chưa cập nhật
                                @else
                                {{ $user->address }}
                                @endif
                            </td>
                            <td>
                                @if($user->role_id == 1)
                                Admin
                                @elseif($user->role_id == 2)
                                Nhân viên
                                @elseif($user->role_id == 3)
                                Khách hàng
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                    data-target="#exampleModal" data-user-id="{{ $user->id }}">
                                    Chi tiết
                                </button>
                                <button type="button" class="btn btn-sm btn-danger"><a
                                        style="color:white;  text-decoration: none;"
                                        href="{{ route('user.remove', ['id'=>$user->id]) }}"> Xóa</a></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết tài khoản</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Nội dung chi tiết tài khoản -->
                <p><strong>Họ tên:</strong> {{ $user->name }} <span id="name"></span></p>
                <p><strong>Email:</strong> {{ $user->email }} <span id="email"></span></p>
                <p><strong>Số điện thoại:</strong> {{ $user->phone }} <span id="phone"></span></p>
                <p><strong>Địa chỉ:</strong>
                    @if($user->address == '')
                    Chưa cập nhật
                    @else
                    {{ $user->address }}
                    @endif
                    <span id="address"></span>
                </p>
                <p><strong>Mô tả:</strong>
                    @if($user->description == '')
                    Chưa cập nhật
                    @else
                    {{ $user->description }}
                    @endif
                    <span id="description"></span>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

@section('script')
<script>
$(document).ready(function() {
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Nút "Chi tiết" được nhấp
        var userId = button.data('user-id'); // Lấy từ User ID từ thuộc tính data-user-id
        console.log(userId);
        // Tạo yêu cầu GET tới API để lấy dữ liệu user từ server
        $.get('/api/users/' + userId, function(data) {
                // Thiết lập dữ liệu user vào modal
                var modal = $('#exampleModal');
                modal.find('.modal-title').text('Chi tiết tài khoản');
                // Đổ dữ liệu user vào các phần tử trong modal
                modal.find('#name').text(data[0].name);
                modal.find('#phone').text(data[0].phone);
                modal.find('#email').text(data[0].email);
                modal.find('#description').text(data[0].description);
                modal.find('#password').text(data[0].password);
                modal.find('#role_id').text(data[0].role_id);

                // Update the data-user-id attribute for Confirm and Cancel buttons
                modal.find('.btn-confirm').attr('data-user-id', userId);
                modal.find('.btn-cancel').attr('data-user-id', userId);
            })
            .fail(function(error) {
                console.log('Lỗi khi gửi yêu cầu API:', error);
            });
    });
});
</script>
@endsection

@endsection