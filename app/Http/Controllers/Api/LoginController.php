<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Resources\LoginResource;

use App\User;
use Auth;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    /**
     * Auths the user with given credentials.
     *
     * @param LoginFormRequest $request
     *
     * @return LoginResource|\Illuminate\Http\JsonResponse
     */
    public function authenticate(LoginFormRequest $request)
    {
        if (Auth::once(json_decode($request->input('data'), true))) {
            return new LoginResource(Auth::user());
        }

        return Response::json(['error' => true]);
    }

    /**
     * Validate user and return it's credentials
     *
     * @return LoginResource|\Illuminate\Http\JsonResponse
     */
    public function rememberMe()
    {
        /** @var User $user */
        $user = Auth::user();
        // check if user allowed to use fts
        if ($user->hasPermissionTo('fts.enabled')) {
            return new LoginResource(Auth::user());
        } else {
            return Response::json(['error' => true]);
        }
    }
}
