<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AppModuleLoginFormRequest;
use App\Http\Resources\LoginResource;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class AppModuleLoginController extends Controller
{
    public function authenticate( AppModuleLoginFormRequest $request  ){
        $credentials = $request->only('name', 'password');
        if( Auth::guard('app_module')->attempt($credentials)  ){
            return new LoginResource(Auth::guard()->user());
        }
        return Response::json(['error' => true]);
    }

}
