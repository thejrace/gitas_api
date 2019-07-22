<?php

namespace App\Http\Controllers;

use App\AppModule;
use App\Http\Resources\AppModuleUserResource;
use Illuminate\Http\Request;

class AppModuleUserController extends Controller
{
    public function dataTables( Request $req, AppModule $appModule ){
        $query = $appModule->users();
        if( $req->filled('sort') ){
            $exp = explode('|', $req->get('sort'));
            if( count($exp) > 1 ) $query->orderBy($exp[0], $exp[1]);
        }
        if( $req->filled('filter')) {
            $query->where('name', 'LIKE', '%'.$req->get('filter').'%');
        }
        return AppModuleUserResource::collection($query->paginate(20));
    }

    public function index(){
        return view('app_module_users');
    }


}
