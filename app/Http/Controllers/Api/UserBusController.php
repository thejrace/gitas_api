<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BusResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\User;
use Illuminate\Http\Request;

class UserBusController extends Controller
{
    /**
     * Get defined buses of the user.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(User $user)
    {
        return BusResource::collection($user->buses);
    }

    /**
     * Define bus to the user.
     *
     * @param Request $request
     * @param User    $user
     *
     * @return SuccessJSONResponseResource
     */
    public function define(Request $request, User $user)
    {
        $user->defineBus($request->input('bus_id'));

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Remove bus definition from the user.
     *
     * @param Request $request
     * @param User    $user
     *
     * @return SuccessJSONResponseResource
     */
    public function undefine(Request $request, User $user)
    {
        $user->undefineBus($request->input('bus_id'));

        return new SuccessJSONResponseResource(null);
    }
}
