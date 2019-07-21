<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserFormStoreRequest;
use App\Http\Requests\UserFormUpdateRequest;
use App\Http\Resources\SuccessJSONResponseResource;
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
        $attributes = $request->all();
        $attributes['api_token']    =  Str::random(60);
        $attributes['password']     = Hash::make($request->get('password'));
        User::create($attributes);
        return new SuccessJSONResponseResource(null);
    }

    public function show($model)
    {
        return new UserResource($model);
    }

    public function update(UserFormUpdateRequest $request, User $model)
    {
        $attributes = $request->all();
        if( $request->filled('password') ){
            $attributes['password'] = Hash::make($request->get('password'));
        }
        $model->update($attributes);
        return new SuccessJSONResponseResource(null);
    }

    public function destroy($model)
    {
        $model->delete();
        return new SuccessJSONResponseResource(null);
    }

}
