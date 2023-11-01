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
            <td><img src="{{$staff->avatar? Storage::url($staff->avatar):
            'data:image/png;base64,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'}}" style="width: 60px; height: 60px;border-radius: 99%;">
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