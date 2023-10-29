@extends('layout/adminlayout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Đây là toàn bộ lịch đã đặt của khách hàng cần bạn xác nhận</h4>
                    <p class="card-title-desc">Chào sếp, nay có rất nhiều lịch cần bạn xác nhận hãy hoàn thành nào.</p>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Loại xe</th>
                                <th>Số KM</th>
                                <th>Ngày giờ đến</th>
                                <th>Trạng thái</th>
                                <th>chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Đinh Việt Đức</td>
                                <td>0346938386</td>
                                <td>Maybach</td>
                                <td>12000Km</td>
                                <td>2011/04/25:12:00</td>
                                <td class="text-danger">Đang xử lí</td>
                                <td>
                                    <button type="button" class="btn btn-primary">Xác nhận</button>
                                    <button type="button" class="btn btn-danger">Hủy</button>
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Chi tiết
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết đặt lịch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Họ và tên: Đinh Việt Đức</p>
                    <p>Số điện thoại: 0346938386</p>
                    <p>Email: hiinenodz@gmail.com</p>
                    <p>Tên xe: Mayback</p>
                    <p>Số Km: 12.000km</p>
                    <p>Các công việc cần làm: <strong>Thay dầu, thay lốp</strong></p>
                    <p>
                      Trạng thái:
                      <span class="text-success" >Đang hoàn thành</span>
                    </p>
                    <p>
                      Thời gian đến dự kiến: 12-2-2022 12:00
                    </p>
                    <p>Ghi chú: Làm nhanh cho anh đi chơi gái</p>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection