<?php

namespace App\Http\Controllers\Api;

use App\AppModule;
use App\AppModuleUser;
use App\Http\Requests\AppModuleUserFormStoreRequest;
use App\Http\Requests\AppModuleUserFormUpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppModuleUserLoginFormRequest;
use App\Http\Resources\AppModuleUserFullDataResource;
use App\Http\Resources\AppModuleUserResource;
use App\Http\Resources\FailJSONResponseResource;
use App\Http\Resources\SuccessJSONResponseResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class AppModuleUserController extends Controller
{
    /**
     * Get all Users
     *
     * @param AppModule $appModule
     *
     * @return AnonymousResourceCollection
     */
    public function index(AppModule $appModule)
    {
        return AppModuleUserResource::collection($appModule->users);
    }

    /**
     * Store a newly created model in storage.
     *
     * @param AppModuleUserFormStoreRequest $request
     *
     * @return SuccessJSONResponseResource
     */
    public function store(AppModuleUserFormStoreRequest $request)
    {
        $attributes = $request->all();
        $attributes['api_token']    = Str::random(60);
        $attributes['password']     = Hash::make($request->get('password'));
        AppModuleUser::create($attributes);
        return new SuccessJSONResponseResource(null);
    }

    /**
     * Display the specified resource.
     *
     * @param AppModule $appModule
     * @param AppModuleUser $model
     *
     * @return AppModuleUserResource
     */
    public function show(AppModule $appModule, AppModuleUser $model)
    {
        return new AppModuleUserResource($model);
    }

    /**
     * Login app module user
     *
     * @param AppModuleUserLoginFormRequest $request,
     *
     * @return FailJSONResponseResource|SuccessJSONResponseResource
     */
    public function login(AppModuleUserLoginFormRequest $request)
    {
        /** @var AppModuleUser $user */
        $user = DB::table('app_module_users')
            ->where('email', $request->input('email'))->first();

        if( !$user ) return new FailJSONResponseResource(null);

        if( Hash::check($request->input('password'), $user->password) ){
            return new SuccessJSONResponseResource(null);
        } else {
            return new FailJSONResponseResource(null);
        }
    }

    /**
     * Display all related data of specified model
     *
     * @param AppModuleUser $model
     *
     * @return AppModuleUserFullDataResource
     */
    public function fetchData(AppModuleUser $model)
    {
        return new AppModuleUserFullDataResource($model);
    }

    /**
     * Update the specified location in storage.
     *
     * @param AppModuleUserFormUpdateRequest  $request
     * @param AppModuleUser                   $model
     *
     * @return SuccessJSONResponseResource
     */
    public function update(AppModuleUserFormUpdateRequest $request, AppModuleUser $model )
    {
        $attributes = $request->all();
        if( $request->filled('password') ){
            $attributes['password'] = Hash::make($request->get('password'));
        }
        $model->update($attributes);
        return new SuccessJSONResponseResource(null);
    }

    /**
     * Remove app module user
     *
     * @param AppModuleUser $model
     *
     * @return SuccessJSONResponseResource
     *
     * @throws \Exception|\Throwable
     */
    public function destroy(AppModuleUser $model)
    {
        DB::transaction(function() use ($model) {
            /** @var Permission $permission */
            // revoke permissions
            foreach ($model->getAllPermissions() as $permission) {
                $model->revokePermissionTo($permission);
            }
            // delete user
            $model->delete();
        });
        return new SuccessJSONResponseResource(null);
    }
}
