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
                    <h4 class="staff-title">Đây là thêm cầu</h4>
                    <form action="{{route('room-create')}}" method="POST" style="display: inline;"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label class="form-label">Tên cầu</label>
                            <input type="text" class="form-control" name="name" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-control" name="status" aria-label="Default select example">
                                <option value="Đang trống">Đang trống</option>
                                <option value="Đang làm">Đang làm</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>

                    </form>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
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
