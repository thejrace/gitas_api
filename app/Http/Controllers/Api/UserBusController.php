<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserBusFormRequest;
use App\Http\Resources\UserBusResource;
use App\UserBus;
use App\Http\Controllers\Controller;

class UserBusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserBusResource::collection(UserBus::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserBusFormRequest $request)
    {
        $userBus = UserBus::create($request->all());
        return new UserBusResource($userBus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userBus = UserBus::findOrFail($id);
        return new UserBusResource($userBus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserBusFormRequest $request, $id)
    {
        $userBus = UserBus::findOrFail($id);
        $userBus->update($request->all());
        return new UserBusResource($userBus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userBus = UserBus::findOrFail($id);
        $userBus->delete();
    }
}
