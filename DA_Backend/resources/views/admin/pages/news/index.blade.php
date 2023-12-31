@extends('admin/layout/layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                       @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <a href="{{route('new.create')}}" class="btn btn-success">thêm mới</a>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên </th>
                                <th>Ảnh</th>
                                <th>Mô tả</th>
                                <th>Nội dung</th>
                                {{-- <th>người đăng</th> --}}
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                     
                            @foreach($data as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->title }}</td>
                                <td ><img style="width:50px" src="{{asset('storage/images/'.$row->image)}}" alt=""></td>
                                <td>{{ substr($row->des,0,10) }}...</td>
                                <td>{{ substr($row->content,0,20) }}...</td>
                               
                                <td>
                                    <div style="display:flex">
                                        <div >
                                        <a href="{{route('new.edit',$row)}}" class="btn btn-success">  
                                         Sửa
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{route('new.destroy',$row)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">xóa</button>
                                        </form>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết đặt lịch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Nội dung chi tiết đặt lịch sẽ được đổ vào đây -->
                <p><strong>Họ tên:</strong> <span id="name"></span></p>
                <p><strong>Số điện thoại:</strong> <span id="phone"></span></p>
                <p><strong>Email:</strong> <span id="email"></span></p>
                <p><strong>Loại xe:</strong> <span id="model_car"></span></p>
                <p><strong>Số KM:</strong> <span id="mileage"></span></p>
                <p><strong>Công việc:</strong> <span id="tasks"></span></p>
                <p><strong>Giá tiền:</strong> <span id="prices"></span></p>
                <p><strong>Ngày giờ đến:</strong> <span id="target_date"></span></p>
                <p><strong>Ghi chú:</strong> <span id="note"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
    </div>
@endsection
