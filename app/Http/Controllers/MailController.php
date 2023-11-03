<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function basic_email()
    {
        $data = array('name' => 'Denish Faldu', 'email' => 'denishfaldu25@gmail.com');

        Mail::send(['text' => 'mail'], array('name' => 'Denish Faldu', 'email' => 'denishfaldu25@gmail.com'), function ($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject('Laravel Basic Testing Mail');
            $message->from('janki.kansagra@rku.ac.in', 'Janki Kansagra');
        });
        echo "Basic Email Sent. Check your inbox.";
    }
    public function html_email()
    {
        $data = array('name' => "Janki Kansagra");
        Mail::send('mail', $data, function ($message) {
            $message->to('denishfaldu25@gmail.com', 'Denish Faldu')->subject('Laravel HTML Testing Mail');
            $message->from('janki.kansagra@rku.ac.in', 'Janki Kansagra');
        });
        echo "HTML Email Sent. Check your inbox.";
    }
    public function attachment_email()
    {
        $data = array('name' => "Janki Kansagra");
        Mail::send('mail', $data, function ($message) {
            $message->to('denishfaldu25@gmail.com', 'Denish Faldu')->subject('Laravel Testing Mail with Attachment');
            $message->attach('\Images\profile_pictures\default.png');
            $message->from('janki.kansagra@rku.ac.in', 'Janki Kansagra');
        });
        echo "Email Sent with attachment. Check your inbox.";
    }
}
