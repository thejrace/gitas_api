<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\PermissionType;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PermissionController extends Controller
{
    /**
     * Generate datatables data for the frontend
     *
     * @param PermissionType $type
     *
     * @return AnonymousResourceCollection
     */
    public function dataTables(PermissionType $type){
        $query = Permission::query();
        $query->where('type', $type->id );
        return PermissionResource::collection($query->paginate(20));
    }

    /**
     * Show index view
     *
     * @param PermissionType $type
     *
     * @return \View
     */
    public function index( PermissionType $type ){
        return view('permissions')->with([
            'permission_type' => $type->id
        ]);
    }
}
