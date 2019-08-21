<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Resources\LoginResource;

use Auth;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    public function authenticate(LoginFormRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::once($credentials)) {
            return new LoginResource(Auth::user());
        }

        return Response::json(['error' => true]);
    }
}
