@extends('admin/layout/layout')
@section('content')
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif
@if ( Session::has('success') )
<strong>{{ Session::get('success') }}</strong> 
@endif 
<div class="row">
    <div class="col-6"> <div class="staff"> <div class="staff-body"> <h4 class="staff-title">Đây là thêm nhân viên</h4>
        <form action="{{route('staff.create')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
        <label for="id_user">Người dùng:</label>
            <select class="form-control" name="id_user" id="id_user" required>
            @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }} -{{($user->role_id == 2) ? 'Nhân viên' : (($user->role_id == 1) ? 'Admin' : 'Người dùng')}}</option>
            @endforeach
    </select>
        </div>
        <dic class="mb-3">
        <input type="text" id="search-input" placeholder="Search...">
            <div>

            </div>
        </dic>
        <div class="mb-3">
            <label class="form-label">Lương</label>
            <input type="text" name="salary" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Đánh giá</label>
            <input type="text" name="review" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Trạng thái</label>
            <input type="text" name="status" class="form-control">
        </div>
        <button class="btn btn-primary">Thêm</button>
        </form>
    </div>
</div> <!-- end col -->
</div> <!-- end row -->
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
            readURL(this, '#anh_preview');
        });

    });
</script>
<script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                var keyword = $(this).val();

                $.ajax({
                    url: "{{ route('search') }}",
                    type: "GET",
                    data: { keyword: keyword },
                    success: function(response) {
                        var tableBody = $('#search-results tbody');
                        tableBody.empty();

                        if (response.length > 0) {
                            $.each(response, function(index, user) {
                                var row = "<p>" + user.name + user.role_id "</p>" ;

                                tableBody.append(row);
                            });
                        } else {
                            var row = "<tr><td colspan='3'>No results found</td></tr>";
                            tableBody.append(row);
                        }
                    }
                });
            });
        });
    </script>
@endsection
@endsection