@extends('admin/layout/layout')
@section('content')
@if (Session::has('success'))
<strong>{{ Session::get('success') }}</strong>
@endif
<div class="row">
    <div class="col-12">
        <div class="staff">
            <div class="staff-body">
                <h4 class="staff-title">Đây là danh sách công việc</h4>
                <table id="datatable" class="table table-striped"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Công việc</th>
                            <th>Giá</th>
                            <th>Xe</th>
                            <th>Người đặt</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr>
                            <td>{{ $job->id }}</td>
                            <td>{{ $job->item_name }}</td>
                            <td>{{ $job->item_price }}</td>
                            <td>{{ $job->model_car }}</td>
                            <td>{{ $job->name }}</td>
                            <td class="text-success">{{ $job->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
             (function( ) {
                 unction readURL(input, selector) {
                     f (input.files && input.files[0]) {
                         et reader = new FileReader();

                         eader.onload = function( e) {
                             (selector).attr('src', e.target.result);
                         ;

                         eader.readAsDataURL(input.files[0]);
                     
                 

                 ("#cmt_anh").change(function( ) {
                     eadURL(this, '#anh_the_preview');
                 );

             );
        </script>
        <script>
             if (Session::h as('message'))
             oastr.options = {
                 closeButton": true,
                 progressBar": true
             
             oastr.success("{{ session('message') }}");
             endif

             if (Session::h as('error'))
             oastr.options = {
                 closeButton": true,
                 progressBar": true
             
             oastr.error("{{ session('error') }}");
             endif

             if (Session::h as('info'))
             oastr.options = {
                 closeButton": true,
                 progressBar": true
             
             oastr.info("{{ session('info') }}");
             endif

             if (Session::h as('warning'))
             oastr.options = {
                 closeButton": true,
                 progressBar": true
             
             oastr.warning("{{ session('warning') }}");
             endif
        </script>
        @endsection
        @endsection