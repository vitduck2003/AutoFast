 <div class="container"  style="border: 1px solid #ccc; border-radius: 5px; padding: 15px;">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                    
                        <div class="invoice-title">
                            <h4 class="text-center">Hóa đơn #{{ $invoice->id }}</h4>
                         
                        </div>
                        <hr>
  <div style="display: flex; justify-content: space-between;">
    <div style="width: 48%;"> <!-- Adjust width as needed -->
        <address>
            <strong>Thông tin khách hàng</strong><br>
            <strong>Họ và tên:</strong><br>
            <strong>Số điện thoại</strong><br>
            <strong>Email:</strong><br>
            <strong>Tên xe:</strong><br>
            <strong>Số km đã đi:</strong><br>
            <strong>Dịch vụ:</strong><br>
            <strong>Trạng thái thanh toán:</strong><br>
        </address>
    </div>
    <div style="width: 48%; justify-content:end"> <!-- Adjust width as needed -->
        <address  style="margin-left:300px" >
            <br>
            {{ $invoice->name }}<br>
            {{ $invoice->phone }}<br>
            {{ $invoice->email }}<br>
            {{ $invoice->model_car }}<br>
            {{ $invoice->mileage }} Km<br>
            {{ $invoice->service_name }}<br>
            {{ $invoice->status_payment }}<br>
        </address>
    </div>
</div>

                        <div class="row">
            <div class="col-sm-6 mt-3" style="float: left; width: 50%;">
                <address>
                    <strong>Kiểu thanh toán :  </strong>
                    @if ($invoice->method_payment == null)
                        Chưa thanh toán
                    @else
                        {{ $invoice->method_payment }}
                    @endif
                </address>
                <address>
                    <strong>Tạo vào ngày : </strong>
                    {{ $invoice->created_at }}
                </address>
    </div>   
</div>
                        <div class="py-2 mt-3">
                        <br>
                            <h3 style="color:" class="font-size-15 font-weight-bold">Danh sách dịch vụ</h3>
                        </div>
                     
<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th style="width: 70px; border: 1px solid #000; padding: 8px;">ID</th>
            <th style="border: 1px solid #000; padding: 8px;">Tên công việc</th>
            <th style="text-align: right; border: 1px solid #000; padding: 8px;">Giá</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jobs as $job)
        <tr>
            <td style="border: 1px solid #000; padding: 8px;">{{ $loop->iteration }}</td>
            <td style="border: 1px solid #000; padding: 8px;">{{ $job->item_name }} @if ($job->note !== null)
                ({{ $job->note }})
                @endif
            </td>
            <td style="text-align: right; border: 1px solid #000; padding: 8px;">{{ number_format($job->item_price, 0, ',', '.') }} VNĐ
            </td>
        </tr>
        @endforeach
        <tr>
            <td  style=" border: 1px solid #000; padding: 8px;">#</td>
            <td   style=" border: 1px solid #000; padding: 8px;">Giảm giá</td>
            <td  style="text-align: right; border: 1px solid #000; padding: 8px;"><h5>{{ number_format($invoice->total_discount) }} VNĐ</h5></td>
        </tr>
        <tr>
            <td  style=" border: 1px solid #000; padding: 8px;">#</td>
            <td style="border: 1px solid #000; padding: 8px;">Tổng tiền</td>
            <td style="border: 1px solid #000; text-align: right; padding: 8px;color:red">
            <h4 >{{ number_format($invoice->total_amount, 0, ',', '.') }} VNĐ</h4>
            </td>
        </tr>
    </tbody>
</table>


                        
                    
                    </div>
                </div>
            </div>
        </div>
    </div>  