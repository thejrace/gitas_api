<?php

namespace App\Http\Controllers\Api;

use App\AppModule;
use App\Http\Requests\AppModuleFormStoreRequest;
use App\Http\Requests\AppModuleFormUpdateRequest;
use App\Http\Resources\AppModuleResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessJSONResponseResource;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AppModuleController extends Controller
{
    public function index()
    {
        return AppModuleResource::collection(AppModule::all());
    }

    public function store(AppModuleFormStoreRequest $request)
    {
        // create a API user for the AppModule
        $attributes = $request->all();
        $attributesForApiUser = $request->all();
        $nameFormed = preg_replace('/\s+/', '', Str::lower($request->get('name')));
        $attributesForApiUser['email'] = $nameFormed.'@gapp_module.com';
        $attributesForApiUser['password'] = Hash::make($nameFormed.'@gitas');
        $attributesForApiUser['api_token'] =  Str::random(60);
        $apiUser = User::create($attributesForApiUser);
        // create model
        $attributes['user_id'] = $apiUser->id;
        AppModule::create( $attributes );
        return new SuccessJSONResponseResource(null);
    }

    public function show($model)
    {
        return new AppModuleResource($model);
    }

    public function update(AppModuleFormUpdateRequest $request, AppModule $model )
    {
        $model->update($request->all());
        return new SuccessJSONResponseResource(null);
    }

    public function destroy($id)
    {
        DB::transaction(function() use ($id) {
            $model = AppModule::findOrFail($id);
            $model->delete();

            // remove permissions and userpermissions


            // remove API user
        });

    }
}
