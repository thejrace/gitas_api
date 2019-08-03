<?php

namespace App\Http\Controllers\Api;

use App\AppModule;
use App\AppModuleUser;
use App\Http\Requests\AppModuleFormStoreRequest;
use App\Http\Requests\AppModuleFormUpdateRequest;
use App\Http\Resources\AppModuleResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\SuccessJSONResponseResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class AppModuleController extends Controller
{
    /**
     * Get all AppModules
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return AppModuleResource::collection(AppModule::all());
    }

    /**
     * Display the specified resource.
     *
     * @param AppModule $model
     *
     * @return AppModuleResource
     */
    public function show(AppModule $model)
    {
        return new AppModuleResource($model);
    }

    /**
     * Store a newly created model in storage.
     *
     * @param AppModuleFormStoreRequest $request
     *
     * @return SuccessJSONResponseResource
     */
    public function store(AppModuleFormStoreRequest $request)
    {
        $attributes = $request->all();
        $attributes['api_token'] =  Str::random(60);
        AppModule::create( $attributes );
        return new SuccessJSONResponseResource(null);
    }

    /**
     * Update the specified location in storage.
     *
     * @param AppModuleFormUpdateRequest  $request
     * @param AppModule                   $model
     *
     * @return SuccessJSONResponseResource
     */
    public function update(AppModuleFormUpdateRequest $request, AppModule $model )
    {
        $model->update($request->all());
        return new SuccessJSONResponseResource(null);
    }

    /**
     * Remove app module
     *
     * @param AppModule $appModule
     *
     * @return SuccessJSONResponseResource
     *
     * @throws \Exception|\Throwable
     */
    public function destroy( AppModule $appModule )
    {
        DB::transaction(function() use ($appModule) {
            /** @var Permission $permission */
            // get all permissions of app module
            $permissionQuery = Permission::query();
            $appModulePermissions = $permissionQuery
                ->where('guard_name', 'app_module_user' )
                ->where('name', 'LIKE', '%'.$appModule->permission_prefix.'.%' )->get();

            /** @var AppModule $appModule */
            /** @var AppModuleUser $appModuleUser */
            // for all module users, revoke their app module permissions
            foreach( $appModule->users as $appModuleUser ){
                foreach( $appModulePermissions as $permission ){
                    if( $appModuleUser->hasPermissionTo($permission) ){
                        $appModuleUser->revokePermissionTo($permission);
                    }
                }
                // now delete app user
                $appModuleUser->delete();
            }

            // remove all module's permissions
            foreach( $appModulePermissions as $permission ){
                $permission->delete();
            }

            // remove app module
            $appModule->delete();
        });
        return new SuccessJSONResponseResource(null);
    }
}
