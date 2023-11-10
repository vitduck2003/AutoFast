@extends('admin/layout/layout')
@section('content')
@if ( Session::has('success') )
<strong>{{ Session::get('success') }}</strong> 
@endif 
<div class="row"> <div class="col-12"> <div class="staff"> <div
    class="staff-body"> <h4 class="staff-title">Đây là toàn bộ nhân viên</h4> <table id="datatable"
    class="table table-striped " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead> <tr> <th>ID</th> <th>Họ tên</th> <th>email</th> <th>Số điện thoại</th> <th>Địa chỉ</th> <th>Mô tả</th> <th>
        Lương</th> <th>Đánh giá</th> <th>Trạng thái</th>
        <th>Ảnh đại diện</th>
        <th>Chức năng</th>
        </tr>
        </thead>
        <tbody class="">
            @foreach($staffs as $staff):
            <tr>
            <td>{{ $staff->id }}</td>
            <td>{{ $staff->name }}</td>
            <td>{{ $staff->email }}</td>
            <td>{{ $staff->phone }}</td>
            <td>{{ $staff->address }}</td>
            <td>{{ $staff->description }}</td> <td>{{ $staff->salary }}</td> <td>{{ $staff->review }}</td>
            <td>{{ $staff->status }}</td>
            <td><img src="{{$staff->avatar? Storage::url($staff->avatar):''}}" style="width: 60px; height: 60px;border-radius: 99%;">
            </td>
            <td>
            <form action="{{ route('staff-delete', ['id'=> $staff->id]) }}" method="POST" style="display: inline;">
                @csrf @method('DELETE') <button type="submit" class="btn btn-danger">Xóa</button></form> 
                  <button  type="button" class="btn btn-success"><a href="{{ route('showDetail', ['id'=> $staff->id]) }}" style="color:white">Sửa</a></button>
            </td>
        </tr>
        @endforeach
        </tbody>
        </table>
        </div>
        </div>
                @section('script')
                <!-- Thư viện jQuery -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                    integrity="sha384-Ds0X1ls0BU+X+gX3sVY7qclY4mBeO8z9qL6ahxRc0QY2yYJ5TQI1vzN0LYW8X0Hh"
                    crossorigin="anonymous"></script>
                <!-- Thư viện Bootstrap JS -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"
                    integrity="sha384-k9o4f/+cB8C0QV6eAlM7i0V0jKj+3tB4XqDyq5djBv8w/3eWt0YJ/6WfqK0IeFVy"
                    crossorigin="anonymous"></script>
                <script>
                    $(function () {
                        function readURL(input, selector) {
                            if (input.files && input.files[0]) {
                                let reader = new FileReader();

                                reader.onload = function (e) {
                                    $(selector).attr('src', e.target.result);
                                };

                                reader.readAsDataURL(input.files[0]);
                            }
                        }

                        $("#cmt_anh").change(function () {
                            readURL(this, '#anh_the_preview');
                        });

                    });
                </script>
                <script>
                      @if(Session::has('message'))
                        toastr.options =
                        {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                                toastr.success("{{ session('message') }}");
                        @endif
                </script>
@endsection
@endsection