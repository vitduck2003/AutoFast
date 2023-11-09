@extends('admin/layout/layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Đây là toàn bộ lịch đã đặt của khách hàng cần bạn xác nhận</h4>
                    <p class="card-title-desc">Chào sếp, nay có rất nhiều lịch cần bạn xác nhận hãy hoàn thành nào.</p>
                    <a href="{{route('service.create')}}" class="btn btn-success">thêm mới</a>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>tên service</th>
                                <th>image_service</th>
                                <th>content</th>
                                <th>chỉnh sửa gần nhất</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row):
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->service_name }}</td>
                                <td ><img style="width:50px" src="{{asset('storage/'.$row->image_service)}}" alt="{{asset('storage/'.$row->image_service)}}"></td>
                                <td>{{ $row->content }}</td>
                                <td>{{ $row->updated_at }}</td>
                          
                                <td>
                                  
                                        <a href="{{route('service.edit',$row)}}" class="btn btn-success">  
                                         Sửa
                                        </a>
                               
                                        <form action="{{route('service.destroy',$row)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">xoas</button>
                                        </form>
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
