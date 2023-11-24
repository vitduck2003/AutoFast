@extends('admin/layout/layout')
@section('content')
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    @if (Session::has('success'))
        <strong>{{ Session::get('success') }}</strong>
    @endif
    <div class="row">
        <div class="col-6">
            <div class="staff">
                <div class="staff-body">
                    <h4 class="staff-title">Đây là thêm nhân viên</h4>
                    <form action="{{ route('staff.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="form-group">
                                <label class="form-label" for="">Tìm người dùng</label>
                                <input type="text" class="form-control" id="input-search-ajax"
                                    placeholder="Tìm người dùng">
                                <input type="hidden" id="input-search-result" name="id_user">
                                <ul id="searchResults" class="search-ajax-result position-absolute "
                                    style="background-color:#FFFFCC ; padding:10px ; width:80%">
                                </ul>
                            </div>
                        </div>
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
            </div>
            <!-- end col -->

        </div>
        <div class="preview-user col-6">

        </div>
        <!-- end row -->
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
        const result = document.getElementById('input-search-ajax');

        function handleItemClick(userID, userName) {
            $('#input-search-ajax').val(userName);
            $('#input-search-result').val(userID);
            $('.search-ajax-result').hide();
            var _userID = userID;
            var _url = "{{ url('storage') }}";

            $.ajax({
                url: 'http://127.0.0.1:8000/api/preview/' + _userID,
                type: 'GET',
                success: function(res) {
                    var _html = '';
                    _html += '<div class="user-item" style="text-align:center">';
                    _html += '<img src="' + _url + '/' + res.avatar +
                        '" style="margin-right:10px;width: 200px; height: 200px;border-radius: 99%;" alt="">';
                    _html += '<h4>Name: ' + res.name + '</h4>';
                    _html += '<p>Email: ' + res.email + '</p>';
                    _html += '<span>SĐT: ' + res.phone + '</span>';
                    _html += '</div>';

                    $('.preview-user').show(300);
                    $('.preview-user').html(_html);
                }
            });
        }

        $('.search-ajax-result').hide();
        $('#input-search-ajax').keyup(function() {
            var _text = $(this).val();
            var _url = "{{ url('storage') }}";

            if (_text != '') {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/search?key=' + _text,
                    type: 'GET',
                    success: function(res) {
                        var _html = '';
                        for (var user of res) {
                            _html +=
                                '<li class="user-item" style="margin:10px;list-style: none;padding: 0;" onclick="handleItemClick(' +
                                user.id + ', \'' + user.name + '\')    ">';
                            _html += '<img src="' + _url + '/' + user.avatar +
                                '" style="margin-right:10px;width: 60px; height: 60px;border-radius: 99%;" alt="">';
                            _html += '<span>' + user.name + '</span>';
                            _html += '</li>';
                        }

                        $('.search-ajax-result').show(300);
                        $('.search-ajax-result').html(_html);
                    }
                });
            } else {
                $('.search-ajax-result').html('');
                $('.search-ajax-result').hide();
            }
        });
    </script>
@endsection
@endsection



