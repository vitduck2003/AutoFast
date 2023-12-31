
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Xác nhận lịch</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h3 {
            color: #333333;
        }
        p {
            color: #666666;
        }
    </style>
</head>
<body>
    <h3>Chào khách hàng {{$name}}</h3>
    <p>Lịch của bạn đã đặt tại AutoFast đã được xác nhận.</p>
    <table>
        <tr>
            <th>Số điện thoại</th>
            <th>Ngày đặt</th>   
            <th>Loại xe</th>
            <th>Số KM</th>
            <th>Ghi chú</th>
        </tr>
        <tr>
            <td>{{$phone}}</td>
            <td>{{$target_date}} {{$target_time }}</td>    
            <td>{{$model_car}}</td>
            <td>{{$mileage}} Km</td>
            <td>{{$note}}</td>
        </tr>
    </table>
    <br>
     <span>Dịch vụ bạn đã đặt</span> <h3> {{$service_name}}</h3>
    <table>
     <tr>
            <th>Các hạng mục bảo dưỡng </th>
            <th class="text-center">Giá</th>
      </tr>
    @foreach ($serice_item as $item)
    <tr>
        <td>{{$item ->item_name}} </td>
        <td>{{ number_format($item->item_price) }} VNĐ</td>
    </tr>
    @endforeach
    <tr>
        <td><h3>Tổng tiền</h3>   </td>
        <td><h2 style="color:red">{{number_format($total_price)}} VNĐ</h2></td>
    </tr>
</table>

</body>
</html>