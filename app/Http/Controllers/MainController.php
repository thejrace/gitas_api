<?php

namespace App\Http\Controllers;

use App\AppModule;
use App\Bus;
use App\Http\Resources\PermissionResource;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class MainController extends Controller
{

    public function index(){
        return view('dashboard');

    }

    public function test( Request $request, User $user ){
        $permisson = Permission::query()->where('id', 1)->get();
        return $permisson;
    }

}
