<?php

namespace App\Http\Controllers;

use App\User;
use Spatie\Permission\Models\Permission;

class MainController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function test(User $user)
    {
        foreach ($user->buses as $role) {
            echo $role;
        }
    }
}
