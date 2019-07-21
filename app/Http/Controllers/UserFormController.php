<?php

namespace App\Http\Controllers;

use App\User;

class UserFormController extends Controller
{
    public function create()
    {
        return view('user_form');
    }
    public function edit( User $user )
    {
        return view('user_form')->with([
            'updateFlag' => true,
            'dataId' => $user->id
        ]);
    }
}
