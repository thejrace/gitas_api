<?php

namespace App\Http\Controllers;

use App\AppModule;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\Permission\Models\Permission;

class AppModulePermissionController extends Controller
{
    /**
     * Generate datatables data for the frontend
     *
     * @param Request   $req
     * @param AppModule $model
     *
     * @return AnonymousResourceCollection
     */
    public function dataTables(Request $req, AppModule $model)
    {
        $query = Permission::query();
        $query->where('name', 'LIKE', '%' . $model->permission_prefix . '%');
        if ($req->filled('sort')) {
            $exp = explode('|', $req->get('sort'));
            if (count($exp) > 1) {
                $query->orderBy($exp[0], $exp[1]);
            }
        }
        if ($req->filled('filter')) {
            $query->orWhere('name', 'LIKE', '%' . $req->get('filter') . '%');
        }

        return PermissionResource::collection($query->paginate(20));
    }

    /**
     * Show index view
     *
     * @param AppModule $appModule
     *
     * @return \View
     */
    public function index(AppModule $appModule)
    {
        return view('app_module_permissions');
    }
}
