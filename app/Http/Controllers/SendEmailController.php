<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\NotifyMail;


class SendEmailController extends Controller
{
    public function index()
    {

      Mail::to('princeppn2002@gmail.com')->send(new NotifyMail());

      
    }
}
