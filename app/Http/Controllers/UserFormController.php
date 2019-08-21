<?php

namespace App\Http\Controllers;

use App\User;

class UserFormController extends Controller
{
    /**
     * Show empty form
     *
     * @return \View
     */
    public function create()
    {
        return view('user_form');
    }

    /**
     * Show update form
     *
     * @param User $user
     *
     * @return \View
     */
    public function edit(User $user)
    {
        return view('user_form')->with([
            'updateFlag' => true,
            'dataId'     => $user->id,
        ]);
    }
}
