<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\User;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function dataTables( Request $req, User $user ){
        return PermissionResource::collection($user->permissions()->paginate(20));
    }

    public function index(){
        return view('user_permissions');
    }



}
