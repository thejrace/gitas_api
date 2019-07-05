<?php

namespace App\Http\Controllers\Api;

use App\EmployeeRole;
use App\Http\Requests\EmployeeRoleFormRequest;
use App\Http\Resources\EmployeeRoleResource;
use App\Http\Controllers\Controller;

class EmployeeRoleController extends Controller
{

    public function index()
    {
        return EmployeeRoleResource::collection(EmployeeRole::all());
    }

    public function store(EmployeeRoleFormRequest $request)
    {
        $employeeRole = EmployeeRole::create($request->all());
        return new EmployeeRoleResource($employeeRole);
    }

    public function show($id)
    {
        $employeeRole = EmployeeRole::findOrFail($id);
        return new EmployeeRoleResource($employeeRole);
    }

    public function update(EmployeeRoleFormRequest $request, $id)
    {
        $employeeRole = EmployeeRole::findOrFail($id);
        $employeeRole->update($request->all());
        return new EmployeeRoleResource($employeeRole);
    }

    public function destroy($id)
    {
        $bus = EmployeeRole::findOrFail($id);
        $bus->delete();
    }
}