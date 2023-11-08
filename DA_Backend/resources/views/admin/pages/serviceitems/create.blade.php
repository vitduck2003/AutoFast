@extends('admin/layout/layout')
@section('content')
<form action="{{route('serviceitem.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên phụ tùng</strong>
                <input type="text" name="item_name" value="" class="form-control"
                    placeholder="phụ tùng name">
                @error('item_name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Chọn dịch vụ</strong>
                <input type="text" name="id_service" value="" class="form-control">
                    
                @error('id_service')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>thời gian hoàn thành</strong>
                <input type="text" name="time_done" value="" class="form-control" placeholder="thời gian hoành thành">
                    
                @error('time_done')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>nhập giá</strong>
                <input type="text" name="price" value="" class="form-control" placeholder="nhập giá">
                @error('price')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ảnh phụ tùng</strong>
                <input type="file" name="image" class="form-control" placeholder="Company Email">
                @error('image')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
      
        <button type="submit" class="btn btn-primary ml-3">Submit</button>
    </div>
</form>

@endsection