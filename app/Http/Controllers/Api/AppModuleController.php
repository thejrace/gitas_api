<?php

namespace App\Http\Controllers\Api;

use App\AppModule;
use App\Http\Requests\AppModuleFormRequest;
use App\Http\Resources\AppModuleResource;
use App\Http\Controllers\Controller;
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

    public function store(AppModuleFormRequest $request)
    {
        // create a API user for the AppModule
        $attributes = $request->all();
        $nameFormed = preg_replace('/\s+/', '', Str::lower($request->get('name')));
        $attributes['email'] = $nameFormed.'@gapp_module.com';
        $attributes['password'] = Hash::make($nameFormed.'@gitas');
        $attributes['api_token'] =  Str::random(60);
        $apiUser = User::create($attributes);
        // create model
        $request->request->set('user_id', $apiUser->id);
        $model = AppModule::create( $request->all() );
        return new AppModuleResource($model);
    }

    public function show($id)
    {
        $model = AppModule::find($id);
        return new AppModuleResource($model);
    }

    public function update(AppModuleFormRequest $request, $id)
    {
        $model = AppModule::findOrFail($id);
        $model->update($request->all());
        return new AppModuleResource($model);
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
