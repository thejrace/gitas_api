<?php

namespace App\Http\Controllers\Api;

use App\EmployeeRole;
use App\Http\Requests\EmployeeRoleFormRequest;
use App\Http\Resources\EmployeeRoleResource;
use App\Http\Controllers\Controller;

class EmployeeRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmployeeRoleResource::collection(EmployeeRole::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRoleFormRequest $request)
    {
        $employeeRole = EmployeeRole::create($request->all());
        return new EmployeeRoleResource($employeeRole);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employeeRole = EmployeeRole::findOrFail($id);
        return new EmployeeRoleResource($employeeRole);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRoleFormRequest $request, $id)
    {
        $employeeRole = EmployeeRole::findOrFail($id);
        $employeeRole->update($request->all());
        return new EmployeeRoleResource($employeeRole);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bus = EmployeeRole::findOrFail($id);
        $bus->delete();
    }
}