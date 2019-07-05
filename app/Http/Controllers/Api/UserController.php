<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserFormStoreRequest;
use App\Http\Requests\UserFormUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceAllData;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function index()
    {
        return UserResourceAllData::collection(User::all());
    }

    public function store(UserFormStoreRequest $request)
    {
        $request->request->set('api_token', Str::random(60));
        $request->request->set('password', Hash::make($request->get('password')));
        $user = User::create($request->all());
        return new UserResource($user);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    public function update(UserFormUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return new UserResource($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

}
