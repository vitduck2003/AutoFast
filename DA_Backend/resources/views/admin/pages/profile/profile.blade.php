@extends('admin/layout/layout')
@section('content')
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="row">
        <div class="col-6">
            <div class="staff">
                <div class="staff-body">
                    <h4 class="staff-title">Thông tin người dùng</h4>
                    <form action="{{ route('update-admin', ['id' => $profile->id]) }}" method="POST" style="display: inline;"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" name="name" value="{{ $profile->name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $profile->email }}">
                        </div>
                        <div class="mb-3"> <label class="form-label">Số điện thoại</label> <input type="text"
                                class="form-control" name="phone" value="{{ $profile->phone }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="{{ $profile->address }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <input type="text" class="form-control" name="description"
                                value="{{ $profile->description }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Sửa</button>

                    </form>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <div class="row form-group ">
            <label class="col-md-3 col-sm-4 control-label">Ảnh đại diện</label>
            <div class="col-md-9 col-sm-8">
                <div class="row">
                    <div class="col-xs-6" style="text-align:center">
                        <form action="{{ route('update-avatar-admin', ['id' => $profile->id]) }}" method="POST"
                            style="display: inline;" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <img id="anh_preview"
                                src="{{ $profile->avatar ? Storage::url($profile->avatar) : 'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg' }}"
                                alt="your avatar" style="width: 200px; height:200px; margin-bottom: 10px;border-radius:70%"
                                class="img-fluid" />
                            <input type="file" name="avatar" accept="avatar/*"
                                class="form-control-file @error('avatar') is-invalid @enderror" id="cmt_anh">
                            <button class="btn btn-success">Sửa ảnh</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
    <!-- Thư viện jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-Ds0X1ls0BU+X+gX3sVY7qclY4mBeO8z9qL6ahxRc0QY2yYJ5TQI1vzN0LYW8X0Hh" crossorigin="anonymous">
    </script>
    <!-- Thư viện Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"
        integrity="sha384-k9o4f/+cB8C0QV6eAlM7i0V0jKj+3tB4XqDyq5djBv8w/3eWt0YJ/6WfqK0IeFVy" crossorigin="anonymous">
    </script>

    <script>
        $(function() {
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        $(selector).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#cmt_anh").change(function() {
                readURL(this, '#anh_preview');
            });

        });
    </script>
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