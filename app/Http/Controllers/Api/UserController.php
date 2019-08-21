<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormStoreRequest;
use App\Http\Requests\UserFormUpdateRequest;
use App\Http\Resources\SuccessJSONResponseResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceAllData;
use App\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Get all Users
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return UserResourceAllData::collection(User::all());
    }

    /**
     * Display the specified resource.
     *
     * @param User $model
     *
     * @return UserResource
     */
    public function show(User $model)
    {
        return new UserResource($model);
    }

    /**
     * Store a newly created model in storage.
     *
     * @param UserFormStoreRequest $request
     *
     * @return SuccessJSONResponseResource
     */
    public function store(UserFormStoreRequest $request)
    {
        $attributes              = $request->all();
        $attributes['api_token'] = Str::random(60);
        $attributes['password']  = Hash::make($request->get('password'));
        User::create($attributes);

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Update the specified location in storage.
     *
     * @param UserFormUpdateRequest $request
     * @param User                  $model
     *
     * @return SuccessJSONResponseResource
     */
    public function update(UserFormUpdateRequest $request, User $model)
    {
        $attributes = $request->all();
        if ($request->filled('password')) {
            $attributes['password'] = Hash::make($request->get('password'));
        }
        $model->update($attributes);

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Remove app user
     *
     * @param User $model
     *
     * @return SuccessJSONResponseResource
     *
     * @throws \Exception|\Throwable
     */
    public function destroy(User $model)
    {
        DB::transaction(function() use ($model) {
            /** @var Permission $permission */
            foreach ($model->getAllPermissions() as $permission) {
                $model->revokePermissionTo($permission);
            }
            $model->delete();
        });

        return new SuccessJSONResponseResource(null);
    }
}
