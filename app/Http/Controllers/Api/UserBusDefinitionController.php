<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserBusDefinitionFormRequest;
use App\Http\Resources\UserBusDefinitionResource;
use App\UserBusDefinition;
use App\Http\Controllers\Controller;

class UserBusDefinitionController extends Controller
{

    public function index()
    {
        return UserBusDefinitionResource::collection(UserBusDefinition::all());
    }

    public function store(UserBusDefinitionFormRequest $request)
    {
        $userBus = UserBusDefinition::create($request->all());
        return new UserBusDefinitionResource($userBus);
    }

    public function show($id)
    {
        $userBus = UserBusDefinition::findOrFail($id);
        return new UserBusDefinitionResource($userBus);
    }

    public function update(UserBusDefinitionFormRequest $request, $id)
    {
        $userBus = UserBusDefinition::findOrFail($id);
        $userBus->update($request->all());
        return new UserBusDefinitionResource($userBus);
    }

    public function destroy($id)
    {
        $userBus = UserBusDefinition::findOrFail($id);
        $userBus->delete();
    }
}
