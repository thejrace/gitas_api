<?php

namespace App\Http\Controllers\Api;

use App\EmploymentStatus;
use App\Http\Requests\EmploymentStatusFormRequest;
use App\Http\Resources\EmploymentStatusResource;
use App\Http\Controllers\Controller;

class EmploymentStatusController extends Controller
{

    public function index()
    {
        return EmploymentStatusResource::collection(EmploymentStatus::all());
    }

    public function store(EmploymentStatusFormRequest $request)
    {
        $employementStatus = EmploymentStatus::create($request->all());
        return new EmploymentStatusResource($employementStatus);
    }

    public function show($id)
    {
        $employementStatus = EmploymentStatus::findOrFail($id);
        return new EmploymentStatusResource($employementStatus);
    }

    public function update(EmploymentStatusFormRequest $request, $id)
    {
        $employementStatus = EmploymentStatus::findOrFail($id);
        $employementStatus->update($request->all());
        return new EmploymentStatusResource($employementStatus);
    }

    public function destroy($id)
    {
        $employementStatus = EmploymentStatus::findOrFail($id);
        $employementStatus::delete();
    }
}
