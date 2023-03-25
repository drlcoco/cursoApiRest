<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    public function index()
{
    $data = app('data');
    return view('emails.email', compact('data'));
}
}
