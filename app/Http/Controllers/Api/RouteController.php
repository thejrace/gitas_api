<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RouteResource;
use App\Http\Resources\SuccessJSONResponseResource;
use App\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return RouteResource::collection(Route::all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return RouteResource
     */
    public function show($id)
    {
        /** @var Route $route */
        $route = \App\Route::findOrFail($id);

        return new RouteResource($route);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return SuccessJSONResponseResource
     */
    public function store(Request $request)
    {
        Route::create($request->all());

        return new SuccessJSONResponseResource(null);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** @var Route $route */
        $route = \App\Route::findOrFail($id);

        $route->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception|\Throwable
     */
    public function destroy($id)
    {
        /** @var Route $route */
        $route = \App\Route::findOrFail($id);

        $route->delete();
    }
}
