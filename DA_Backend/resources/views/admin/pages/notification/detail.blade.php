@extends('admin/layout/layout')
@section('content')


<div class="employee-details">
    <h2>Chi tiết thông báo</h2>
    <p><strong>Tên người đặt:</strong> {{$notifications->name}}</p>
    <p><strong>Tiêu đề:</strong> {{$notifications->title}}</p>
    <p><strong>Nội dung:</strong> {{$notifications->content }} {{$notifications->name}}</p>
    <p><strong>Số điện thoại người đặt:</strong> {{$notifications->phone}}</p>
    <p><strong>Thời gian đặt:</strong>{{$notifications->target_date}} {{$notifications->target_time}}</p>
    <p><strong>Thời gian thông báo:</strong>
        @php
            $currentTime = time();
            $createdTime = strtotime($notifications->created_at);

            $timeDiffInSeconds = $currentTime - $createdTime;

            if ($timeDiffInSeconds >= 3600) {
            $hoursDiff = floor($timeDiffInSeconds / 3600);
            $displayTime = $hoursDiff . ' giờ trước';
            } else {
            $minutesDiff = floor($timeDiffInSeconds / 60);
            $displayTime = $minutesDiff . ' phút trước';
            }
        @endphp

        {{ $displayTime }}</p>
</div>
@section('script')

@endsection
@endsection