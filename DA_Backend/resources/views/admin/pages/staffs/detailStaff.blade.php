@extends('admin/layout/layout')
@section('content')


<div class="employee-details">
    <h2>Chi tiết nhân viên</h2>
    <img src="{{ $staff->avatar ? Storage::url($staff->avatar) : 'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg' }}" alt="Ảnh nhân viên">
    <p><strong>Tên:</strong> {{$staff->name}}</p>
    <p><strong>Trạng thái:</strong> {{$staff->status}}</p>
    <p><strong>Mô tả:</strong> {{$staff->description}}</p>
    <p><strong>Email:</strong> {{$staff->email}}</p>
    <p><strong>Số điện thoại:</strong> {{$staff->phone}}</p>
    <p><strong>Địa chỉ:</strong> {{$staff->address ? $staff->address : 'Chưa cập nhập'}}</p>
  </div>
@section('script')

@endsection
@endsection