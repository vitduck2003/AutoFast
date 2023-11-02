<?php

namespace App\Http\Controllers\Admin\Invoices;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function index(){
        $bills = DB::table('bill')
        ->join('booking', 'bill.id_booking', '=', 'booking.id')
        ->join('booking_detail', 'booking_detail.id_booking', '=', 'bill.id_booking')
        ->join('services', 'services.id', '=', 'booking_detail.id_service')
        ->select('booking.name', 'booking.model_car', 'services.service_name', 'bill.status_payment', 'bill.id', 'bill.total_amount')
        ->get();
        // dd($bills);
        return view('admin/pages/invoices/invoice', compact('bills'));
    }
    public function createInvoice(Request $request)
    {
        $data = $request->except('_token');
        DB::table('bill')->insert([
            'id_booking' => $data['id_booking'],
            'total_amount' => $data['total_amount'],
            'status_payment' => "Chưa thanh toán",
            'created_at' => now()->toDateTimeString()
        ]);
        return redirect()->back()->with('success','Tạo hóa đơn thành công');
    }
    public function detailInvoice($id){
        $invoice = DB::table('bill')
        ->join('booking', 'booking.id', '=', 'bill.id_booking')
        ->join('jobs', 'jobs.id', '=', 'booking.id')
        ->select('bill.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'bill.created_at', 'bill.total_amount', 'booking.id as id_booking', 'bill.created_at')
        ->first();
        $jobs = DB::table('jobs')
        ->select('item_name', 'item_price')
        ->where('id_booking', '=', $invoice->id_booking)
        ->get();
        // dd($invoice, $jobs);
        return view('admin/pages/invoices/invoiceDetail', compact('invoice', 'jobs'));
    }
}
