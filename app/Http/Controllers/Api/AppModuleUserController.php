<?php

namespace App\Http\Controllers\Api;

use App\AppModuleUser;
use App\Http\Requests\AppModuleUserFormStoreRequest;
use App\Http\Requests\AppModuleUserFormUpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppModuleUserResource;
use App\Http\Resources\SuccessJSONResponseResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AppModuleUserController extends Controller
{

    public function store(AppModuleUserFormStoreRequest $request)
    {
        $attributes = $request->all();
        $attributes['api_token']    =  Str::random(60);
        $attributes['password']     = Hash::make($request->get('password'));
        AppModuleUser::create($attributes);
        return new SuccessJSONResponseResource(null);
    }

    public function show( AppModuleUser $model)
    {
        return new AppModuleUserResource($model);
    }


    public function update(AppModuleUserFormUpdateRequest $request, AppModuleUser $model )
    {
        $attributes = $request->all();
        if( $request->filled('password') ){
            $attributes['password'] = Hash::make($request->get('password'));
        }
        $model->update($attributes);
        return new SuccessJSONResponseResource(null);
    }

    public function destroy( AppModuleUser $model )
    {
        $model->delete();
        return new SuccessJSONResponseResource(null);
    }
}
