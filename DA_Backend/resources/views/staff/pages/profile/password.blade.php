@extends('staff/layout/layout')
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
            <div class="staff-body">
                <h4 class="staff-title">Đổi mật khẩu</h4>
                <form action="{{ route('change-password', ['id' => $user->id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu hiện tại</label>
                        <input type="password" class="form-control" name="current_password" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control" name="password" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nhập lại mật khẩu mới </label>
                        <input type="password" class="form-control" name="confirm_password" >
                    </div>
                    <button class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
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
