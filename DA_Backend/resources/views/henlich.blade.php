<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hẹn đặt lịch lần sau</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h3 {
            color: #333;
            margin-bottom: 5px;
        }
        p {
            color: #555;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        span {
            font-weight: bold;
            color: #007bff;
            display: inline-block;
          
        }
 
      
    </style>
</head>
<body>
    <h3>Chào khách hàng {{$name}}</h3>
    <p>Cảm ơn bạn đã sử dụng dịch vụ bảo dưỡng của chúng tôi</p>

    <div class="service-info">
        <span>Dịch vụ bạn đã đặt:</span>
        <h3 class="service-name">{{$service_name}}</h3>
    </div>

    <p>Đã bảo dưỡng xe của bạn <span>{{$model_car}}</span> đã chạy <span>{{ number_format($mileage) }} km</span></p>
    <p>Hẹn bạn quay lại sau khi xe chạy được <span style="color:red">{{ number_format($mileage + 5000) }} km</span> để đảm bảo xe hoạt động tốt nhất</p>

    <div class="contact-info">
        <p>Trân trọng,</p>
        <p style="font-weight: bold;">Gara AutoFast</p>
        <p style="font-weight: bold;">Số điện thoại: 0987654321</p>
        <p style="font-weight: bold;">Địa chỉ: Văn Bô, Mỹ Đình, Hà Nội</p>
    </div>
</body>
</html>
