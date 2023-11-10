<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Failed</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Custom CSS -->
  <style>
    .error-icon {
      color: #dc3545;
      font-size: 72px;
      margin-bottom: 20px;
    }
    .center-div {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .card {
      width: 500px;
    }
    .btn-primary {
      font-size: 18px;
      padding: 10px 20px;
    }
    .transaction-info {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      padding: 20px;
    }
    .transaction-info p {
      margin-bottom: 0;
    }
    .transaction-info .text-right {
      text-align: right;
    }
    .transaction-info .text-left {
      text-align: left;
    }
  </style>
</head>

<body>
        
  <div class="center-div">
    <div class="card">
      <div class="card-header bg-danger text-white">
        <h5 class="card-title text-center p-1">Thanh toán thất bại</h5>
      </div>
      <div class="card-body">
        <div class="text-center">
          <i class="fas fa-times-circle error-icon"></i>
          <h4>Thanh toán của bạn không thành công!</h4>
        </div>
        <hr>
        <h5 class="text-center">Thông tin người thanh toán</h5>
        <div class="transaction-info">
          <div>
            <p class="p-2"><strong>Hinh thức thanh toán</strong></p>
            <p class="p-2"><strong>Người thanh toán</strong></p>
            <p class="p-2"><strong>Mã giao dịch:</strong></p>
            <p class="p-2"><strong>Số tiền:</strong></p>
          </div>
          <div>
            <p class="text-right p-2">VISA</p>
            <p class="text-right p-2">ĐINH VIỆT ĐỨC</p>
            <p class="text-right p-2">H85YG7HU</p>
            <p class="text-right p-2"><strong>450.000VNĐ</strong></p>
            
          </div>
        </div>
        <hr>
        <div class="text-center">
             <a href="http://localhost:5173/" class="btn btn-primary">Quay lại trang chủ</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>