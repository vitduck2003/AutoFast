@extends('admin/layout/layout')
@section('content')
@if (Session::has('success'))
<strong>{{ Session::get('success') }}</strong>
@endif
<div class="row">
    <div class="col-12">
        <div class="staff">
            <div data-simplebar="" style="max-height: 230px;">

                @foreach ($notifications as $notification)
                <a href="" class="text-reset notification-item">
                    <div class="media">
                        <div class="media-body">
                            <h6 class="mt-0 mb-1">{{$notification->title}}</h6>
                            <div class="font-size-12 text-muted">
                                <p class="mb-1">{{$notification->content}}</p>
                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                    @php
                                    $currentTime = time();
                                    $createdTime = strtotime($notification->created_at);

                                    $timeDiffInSeconds = $currentTime - $createdTime;

                                    if ($timeDiffInSeconds >= 3600) {
                                    $hoursDiff = floor($timeDiffInSeconds / 3600);
                                    $displayTime = $hoursDiff . ' giờ trước';
                                    } else {
                                    $minutesDiff = floor($timeDiffInSeconds / 60);
                                    $displayTime = $minutesDiff . ' phút trước';
                                    }
                                    @endphp

                                    {{ $displayTime }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
                <div class="pagination">
                    {{ $notifications->links() }}
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
            @if (Session:: has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
            @endif

            @if (Session:: has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
            @endif

            @if (Session:: has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
            @endif

            @if (Session:: has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
            @endif
        </script>
        @endsection
        @endsection