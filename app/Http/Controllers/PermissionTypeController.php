<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionTypeResource;
use App\PermissionType;
use Illuminate\Http\Request;

class PermissionTypeController extends Controller
{
    public function index(){
        return view('permission_types');
    }

    public function dataTables( Request $req ){
        $query = PermissionType::query();
        if( $req->filled('sort') ){
            $exp = explode('|', $req->get('sort'));
            if( count($exp) > 1 ) $query->orderBy($exp[0], $exp[1]);
        }
        if( $req->filled('filter')) {
            $query->orWhere('nane', 'LIKE', '%'.$req->get('filter').'%');
        }
        return PermissionTypeResource::collection($query->paginate(20));

    }
}
