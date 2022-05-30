<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SMSNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;
use Twilio\Rest\Client;

class SmsMsgController extends Controller
{
    public function sendSmsToMobile()
    {
        $basic  = new \Nexmo\Client\Credentials\Basic('6807c46c', '0czdmXRKbMP10vEK');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => '+919497412943',
            'from' => 'athulWAC',
            'text' => 'halo athul this is test msg '
        ]);

        dd('SMS has sent.');
    }





    public function sendMessage()
    {
        $message = "twilio test messsage ";
        $recipients = "+919497412943";

        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");


        $client = new Client($account_sid, $auth_token);
        // dd($client);
        $client->messages->create(
            $recipients,
            ['from' => $twilio_number, 'body' => $message]
        );

        dd('message sent');
    }
}
