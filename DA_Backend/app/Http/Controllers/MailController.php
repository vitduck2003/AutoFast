<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller {
//    public function html_email() {
//     Mail::send('booking', $content, function($message) {
//        $message->to($content['email'], 'Tutorials Point')->subject($subject);
//        $message->from('baoduongautofast@gmail.com','Virat Gandhi');
//     });
//     echo "HTML Email Sent. Check your inbox.";
//  }

 public function xac_nhan_dat_lich($userdata) {
   $data = $userdata;
   Mail::send('booking', $data, function($message) use($userdata) {
      $message->to($userdata['email'], $userdata['name'])->subject
         ('Đặt thành công dịch vụ '.$userdata['service_name']);
      $message->from('baoduongautofast@gmail.com','Gara Autofast');
   });

}
public function lich_dat_thanh_cong($userdata) {
   $data = $userdata;
   Mail::send('confirmbooking', $data, function($message) use($userdata) {
      $message->to($userdata['email'], $userdata['name'])->subject
         ('Lịch '.$userdata['service_name']. ' của bạn đã được xác nhận');
      $message->from('baoduongautofast@gmail.com','Gara Autofast');
   });

}
public function hen_dat_lich($userdata) {
   $data = $userdata;
   Mail::send('henlich', $data, function($message) use($userdata) {
      $message->to($userdata['email'], $userdata['name'])->subject
         ('Hẹn bạn quay lại đặt lịch ');
      $message->from('baoduongautofast@gmail.com','Gara Autofast');
   });

}
public function sendbill($userdata) {
   $data = $userdata;
   Mail::send('billMail', $data, function($message) use($userdata) {
      $message->to($userdata['email'], $userdata['name'])->subject
         ('Hẹn bạn quay lại đặt lịch ');
      $message->from('baoduongautofast@gmail.com','Gara Autofast');
   });

  

}

   public function attachment_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
         $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
}