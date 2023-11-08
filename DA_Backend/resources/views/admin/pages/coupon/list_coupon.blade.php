@extends('admin/layout/layout')
@section('content')

<div class="row"> 
    <div class="col-12"> 
        <div class="card">
            <div class="card-body">
            <h4 class="card-titles">Đây là toàn bộ mã khuyến mãi</h4>

            <?php
                $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message',null);
                    }
            ?>
            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Tên mã giảm giá</th>
                            <th>Mã giảm giá</th>
                            <th>Số lượng giảm giá</th>
                            <th>Điều kiện giảm giá</th>
                            <th>Số giảm</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($coupon as $key => $cou)
                        <tr>
                            <td>{{ $cou->coupon_name }}</td>
                            <td>{{ $cou->coupon_code }}</td>
                            <td>{{ $cou->coupon_time }}</td>
                            <td><span class="text-ellipsis">
                        
                        @if($cou->coupon_condition==1)
                        
                            Giảm theo %
                        @else
                            Giảm theo tiền
                        @endif
                        </span></td>
                        
                         <td>
                            <span class="text-ellipsis">
                        
                        @if($cou->coupon_condition==1)
                            Giảm {{$cou->coupon_number}} %
                        @else
                            Giảm {{$cou->coupon_number}} k
                        @endif
                        
                        </span></td>

                        <td>
                        <a onclick="return confirm('Bạn có chắc là muốn xóa mã này ko?')" href="{{ route('coupon.delete', ['coupon_id'=>$cou->coupon_id] )}}" class="active styling-edit" ui-toggle-class="">
                            <i class="fa fa-times text-danger text"></i>
                        </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection