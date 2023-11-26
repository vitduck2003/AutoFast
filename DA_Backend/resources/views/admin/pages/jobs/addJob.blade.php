@extends('admin/layout/layout')
@section('content')
<form method="POST" action="{{ route('add.job') }}">
    <!-- Các trường form khác -->

    <div class="form-group">
        <label for="formGroupExampleInput2">Chọn dịch vụ</label> <br>
        <select name="service_item" class="form-select mb-2" aria-label="Default select example">
            <option value="">Chọn dịch vụ</option>
            @foreach($jobs as $job)
                <option value="{{ $job->id }}">{{ $job->item_name }}</option>
            @endforeach
        </select> <br>
        @error('service_item')
            <span class="text-danger">Hãy thêm dịch vụ cần thêm</span>
        @enderror
    </div>

    <div class="form-group">
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Ghi chú (Bắt buộc)</label>
            <textarea name="note" class="form-control mb-2" id="exampleFormControlTextarea1" rows="3"></textarea>
            @error('note')
                <span class="text-danger">Nhập ghi chú (VD: Dịch vụ thêm)</span>
            @enderror
        </div>
    </div>

    <input type="hidden" name="id" value="{{ $id }}">
    <button type="submit" class="btn btn-primary">Thêm dịch vụ</button>

    @csrf
</form>
@endsection