@extends('admin/layout/layout')


@section('content')
   @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
<form action="{{route('new.update',$new)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên new</strong>
                <input type="text" name="title" value="{{$new->title}}" class="form-control"
                    placeholder="new name">
                @error('title')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ảnh new</strong>
                <td ><img style="width:50px" src="{{asset('storage/images/'.$new->image)}}" alt=""></td>
                <input type="file" style="height:50px" name="image" class="form-control" placeholder="new Email">
                @error('image_new')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mô tả</strong>
         
                <input type="text" name="des" value="{{$new->des}}" class="form-control"
                    placeholder="new mô tả">
                @error('des')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>nội dung</strong>
                <br>
                <textarea id="" name="content" rows="4" cols="50">{{$new->content}}  </textarea>
                @error('content')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary ml-3">Submit</button>
    </div>
</form>

@endsection