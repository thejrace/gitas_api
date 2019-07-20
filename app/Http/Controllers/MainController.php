<?php

namespace App\Http\Controllers;

use App\Bus;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //

    public function index(){
        return view('dashboard');

    }

    public function test( Request $request, $id ){
        $model = Bus::findOrFail($id)->first();

        return $model;

    }

}
