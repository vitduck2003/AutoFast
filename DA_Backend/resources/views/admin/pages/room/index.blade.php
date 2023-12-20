@extends('admin/layout/layout')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Danh sách cầu</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            @foreach($rooms as $room)
            <div class="col-xl-4 col-sm-6">
                <div style="@if($room->status == 'Đang trống') background-color:#FFB319 @else background-color:#008FFB @endif" class="card text-center">
                    <div class="card-body">
                        <h5 class="font-size-15">{{$room->name}}</h5>
                        <p class="text-white ">
                            {{$room->status}}</p>
                    </div>
                </div>
            </div>
            @endforeach



        </div>
        <!-- end row -->
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="text-center my-3">
                    <a href="javascript:void(0);" class="text-success"><i class="bx bx-hourglass bx-spin mr-2"></i> Load
                        more </a>
                </div>
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div> <!-- container-fluid -->
</div>
@section('script')

@endsection
@endsection