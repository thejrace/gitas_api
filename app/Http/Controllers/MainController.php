<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class MainController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }



    public function test(User $user)
    {
        $user->buses->pluck('id');
    }
}
