@extends('admin/layout/layout')
@section('content')
   @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
<form action="{{route('serviceitem.update',$serviceitem->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên phụ tùng</strong>
                <input type="text" name="item_name" value="{{$serviceitem->item_name}}" class="form-control"
                    placeholder="phụ tùng name" required>
                @error('item_name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Chọn dịch vụ</strong>     <br>
                <select style="width:300px;height:30px" name="id_service" id="">
                    <option style="width:200px" value="{{$serviceitem->idservice}}">{{$serviceitem->servicename}}</option>
                    <option style="width:200px" value="">Không chọn</option>
               @foreach ($dataservice as $dataservice)
                <option style="width:200px" value="{{$dataservice->id}}">{{$dataservice->service_name}}</option>
               @endforeach
             </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>thời gian hoàn thành</strong>
                <input type="text" name="time_done" value="{{$serviceitem->time_done}}" class="form-control" required placeholder="chọn gian hoành thành">
                    
                @error('time_done')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>nhập giá</strong>
                <input type="text" name="price" value="{{$serviceitem->price}}" class="form-control" required placeholder="nhập giá sản phẩm">
                @error('price')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ảnh phụ tùng</strong>
                <img style="width:50px" src="{{asset('storage/images/'.$serviceitem->image)}}" alt="">
                <input  style="height:50px"  type="file" name="image" class="form-control" placeholder="">
                @error('image')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
      
        <button type="submit" class="btn btn-primary ml-3">Submit</button>
    </div>
</form>

@endsection