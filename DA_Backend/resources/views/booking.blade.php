
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
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
    <h3>Chào {{$name}}</h3>
    <p>Lịch của bạn đã đặt thành công.</p>
    <table>
        <tr>
            <th>Số điện thoại</th>
            <th>Ngày đặt</th>   
            <th>Model Car</th>
            <th>Mileage</th>
            <th>Note</th>
        </tr>
        <tr>
            <td>{{$phone}}</td>
            <td>{{$target_date}} {{$target_time }}</td>    
            <td>{{$model_car}}</td>
            <td>{{$mileage}}</td>
            <td>{{$note}}</td>
        </tr>
    </table>
    <br>
     <p>Dịch vụ bạn đã đặt</p><h3> {{$service_name}}</h3>
    <table>
     <tr>
        
            <th>Tên dịch vụ </th>
            <th>giá</th>
      </tr>
    @foreach ($serice_item as $item)
    <tr>
        
        <td>{{$item ->item_name}} </td>
        <td>{{$item->item_price}}</td>
    </tr>
    @endforeach
</table>

</body>
</html>