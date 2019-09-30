<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserBusController extends Controller
{
    public function index()
    {
        return view('user_buses');
    }


}
