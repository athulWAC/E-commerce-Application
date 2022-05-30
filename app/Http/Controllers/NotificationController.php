<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ProductEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class NotificationController extends Controller
{
    public function send()
    {

        // this code is run in add product function in admincontroller


        $user = User::first();

        $message = [
            'greeting' => 'Hi ' . $user->name . ',',
            'body' => 'you have added a new product',
            'thanks' => 'Thank you for adding a product',
            'actionText' => ' add product',
            'actionURL' => url('http://localhost/invoice-system/product'),
            'id' => 57
        ];

        FacadesNotification::send($user, new ProductEmailNotification($message));

        dd('Notification sent!');
    }
}
