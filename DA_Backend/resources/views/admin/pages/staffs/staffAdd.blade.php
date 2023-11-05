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
            <div class="form-group">
                <label class="form-label" for="">Tìm người dùng</label>
                <input type="text" class="form-control" id="input-search-ajax" placeholder="Tìm người dùng">
                <div class="search-ajax-result position-absolute  " style="background-color:#FFFFCC ; padding:10px ; width:80%">
                    <div class="media d-flex align-items-center" >
                        <a class="pull-left">
                            <img class="media-object" src="https://scontent.fsgn2-11.fna.fbcdn.net/v/t39.30808-6/217344925_370392091142406_4709204799596881558_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=5f2048&_nc_eui2=AeHCr9KXIs1OQjcW53u8guWNNj4-snVt1HY2Pj6ydW3UdrCfzySrLPeRhN2XOwbRtTLpcUZPrGojYDdBV_g3jzHQ&_nc_ohc=TL_ND6ckhwIAX9bbzWW&_nc_ht=scontent.fsgn2-11.fna&oh=00_AfAnTm659qzviTHTIViX_nyAPV4aHdG9VjS7Uz3OqfSP3Q&oe=654D5D50" alt="" style="width: 60px; height: 60px;border-radius: 99%;"  >
                        </a>
                        <div class="media-body p-2">
                            <h5 class="mt-0">Media heading</h5>
                            <p>hungpv@gmail.com</p>
                      </div>
                    </div>

                </div>
                
                
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
        $('.input-search-ajax').keyup(function () {
          var _text=$(this).val();
          alert(_text)  
        })
    </script>
@endsection
@endsection