<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller {
<<<<<<< HEAD
   public function basic_email() {
      $data = array('name'=>"trong day");
   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('hiinenodz@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('trongnhph21822@fpt.edu.vn','trong day');
      });
      echo "Basic Email Sent. Check your inbox.";

   }  
   
   

   public function html_email() {
      $data = array('name'=>"trong day");
      Mail::send('mail', $data, function($message) {
         $message->to('hiinenodz@gmail.com', 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         $message->from('trongnhph21822@fpt.edu.vn','trong day');
      });
      echo "HTML Email Sent. Check your inbox.";
   }



=======
   public function html_email($content, $subject) {
    dd($content);
    Mail::send('booking', $content, function($message) {
       $message->to($content['email'], 'Tutorials Point')->subject($subject);
       $message->from('baoduongautofast@gmail.com','Virat Gandhi');
    });
    echo "HTML Email Sent. Check your inbox.";
 }
>>>>>>> 8ac1cf1c46884dc38466b736620720c4bd1a8323
   public function attachment_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
<<<<<<< HEAD
         $message->to('hiinenodz@gmail.com', 'Tutorials Point')->subject
=======
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
>>>>>>> 8ac1cf1c46884dc38466b736620720c4bd1a8323
            ('Laravel Testing Mail with Attachment');
         $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
         $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
}