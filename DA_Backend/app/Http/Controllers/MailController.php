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
         ('Lịch của bạn đã được đặt');
      $message->from('trongdua2098@gmail.com','khong quan trong');
   });

}
public function lich_dat_thanh_cong($userdata) {
   $data = $userdata;
   Mail::send('booking', $data, function($message) use($userdata) {
      $message->to($userdata['email'], $userdata['full_name'])->subject
         ('Lịch của bạn đã được xác nhận');
      $message->from('trongdua2098@gmail.com','khong quan trong');
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