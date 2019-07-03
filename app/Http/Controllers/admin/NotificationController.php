<?php

namespace App\Http\Controllers\admin;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function shownotification()
    {
        return view('cpanel.notification.index');
    }
    public function sendnotification(Request $request)
    {
      $client=Client::all();
      $message=$request->message;
      for($i=0;$i<count($client);$i++)
      {
         $login=$client[$i]['login'];
        if($login == 1)
        {
          $player_id=$client[$i]['device_id'];
          $content = array(
            "en" => $message
            );
            $heading = array(
               "en" => "Application"
            );
          $fields = array(
            'app_id' => "840f2936-ab8a-4db7-9f06-1ee126ab7384",
            'include_player_ids' => [$player_id],
            'data' => array("foo" => $message),
            'contents' => $content,
            'headings' => $heading
          );
      //    return $fields;
          $fields = json_encode($fields);
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                 'Authorization: Basic MTg0YjNhYTUtMjVkZi00MWFkLTlkMWMtMDIzMzM1ZThiNGQw'));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HEADER, FALSE);
          curl_setopt($ch, CURLOPT_POST, TRUE);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
          $response = curl_exec($ch);
          curl_close($ch);
        }
      }
      return redirect('admin/shownotification')->with('send', ' Successfully');
    }
}
