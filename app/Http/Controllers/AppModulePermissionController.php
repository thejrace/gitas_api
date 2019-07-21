<?php

namespace App\Http\Controllers;

use App\AppModule;
use App\Http\Resources\AppModulePermissionResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class AppModulePermissionController extends Controller
{

    public function dataTables( Request $req, AppModule $model ){
        $query = Permission::query();
        $query->where('name', 'LIKE', '%'.$model->permission_prefix.'%');

        if( $req->filled('sort') ){
            $exp = explode('|', $req->get('sort'));
            if( count($exp) > 1 ) $query->orderBy($exp[0], $exp[1]);
        }
        if( $req->filled('filter')) {
            $query->orWhere('name', 'LIKE', '%'.$req->get('filter').'%');
        }
        return AppModulePermissionResource::collection($query->paginate(20));
    }

    public function index(){
        return view('app_module_permissions');
    }

}
