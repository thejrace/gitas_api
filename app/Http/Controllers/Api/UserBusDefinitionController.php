<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserBusDefinitionFormRequest;
use App\Http\Resources\UserBusDefinitionResource;
use App\UserBusDefinition;
use App\Http\Controllers\Controller;

class UserBusDefinitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserBusDefinitionResource::collection(UserBusDefinition::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserBusDefinitionFormRequest $request)
    {
        $userBus = UserBusDefinition::create($request->all());
        return new UserBusDefinitionResource($userBus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userBus = UserBusDefinition::findOrFail($id);
        return new UserBusDefinitionResource($userBus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserBusDefinitionFormRequest $request, $id)
    {
        $userBus = UserBusDefinition::findOrFail($id);
        $userBus->update($request->all());
        return new UserBusDefinitionResource($userBus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userBus = UserBusDefinition::findOrFail($id);
        $userBus->delete();
    }
}
