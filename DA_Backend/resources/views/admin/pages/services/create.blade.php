@extends('admin/layout/layout')


@section('content')
<form action="{{route('service.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên dịch vụ</strong>
                <input type="text" name="service_name" value="" class="form-control"
                    placeholder="Company name">
                @error('service_name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ảnh dịch vụ</strong>
                <input type="file" name="image_service" class="form-control" placeholder="Company Email"
                   >
                @error('image_service')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nội dung</strong>
                <input type="text" name="content" value="" class="form-control"
                    placeholder="Company Address">
                @error('content')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary ml-3">Submit</button>
    </div>
</form>

@endsection