@extends('admin/layout/layout')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Users Grid</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                            <li class="breadcrumb-item active">Users Grid</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            @foreach($staffs as $staff)
            <div class="col-xl-3 col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <img style="border-radius:99%; width:70px;height:70px;" src="{{$staff->avatar ? Storage::url($staff->avatar) : 'https://png.pngtree.com/png-vector/20210128/ourlarge/pngtree-flat-default-avatar-png-image_2848906.jpg'}}" class="card-img-top" alt="Ảnh nhân viên 1">
                        <h5 class="font-size-15">{{$staff->name}}</h5>
                        <p class="text-muted">{{$staff->status}}</p>
                    </div>
                    <div class="card-footer bg-transparent border-top">
                        <div class="contact-links d-flex font-size-20">
                            <div class="flex-fill">
                                <a href="{{ route('jobByStaff', ['id' => $staff->id]) }}" data-toggle="tooltip" data-placement="top" title="Công việc"><i
                                        class="bx bx-pie-chart-alt"></i></a>
                            </div>
                            <div class="flex-fill">
                                <a href="{{ route('staffDetail', ['id' => $staff->id]) }}" data-toggle="tooltip" data-placement="top" title="Thông tin cá nhân"><i
                                        class="bx bx-user-circle"></i></a>
                            </div>
                        </div>
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