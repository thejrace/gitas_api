<?php

namespace App\Http\Controllers\Api;

use App\Bus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BusResource;
use App\Http\Requests\BusFormStoreRequest;
use App\Http\Requests\BusFormUpdateRequest;


class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BusResource::collection(Bus::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusFormStoreRequest $request)
    {
        $bus = Bus::create( $request->all() );
        return new BusResource($bus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bus = Bus::find($id);
        return new BusResource($bus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BusFormUpdateRequest $request, $id)
    {
        $bus = Bus::findOrFail($id);
        $bus->update($request->all());
        return new BusResource($bus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bus = Bus::find($id);
        $bus->delete();
    }
}
