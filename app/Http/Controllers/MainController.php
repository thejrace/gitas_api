<?php

namespace App\Http\Controllers;

use App\AppModule;
use App\Bus;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class MainController extends Controller
{
    //

    public function index(){
        return view('dashboard');

    }

    public function test( Request $request, AppModule $model ){

        $query = Permission::query();
        $query->where('name', 'LIKE', '%'.$model->permission_prefix.'%');

        return $query->paginate(20);
    }

}
