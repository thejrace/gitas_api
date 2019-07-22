<?php

namespace App\Http\Controllers;

use App\AppModule;
use App\Http\Resources\AppModuleResource;
use Illuminate\Http\Request;

class AppModuleController extends Controller
{
    public function dataTables( Request $req ){
        $query = AppModule::query();
        if( $req->filled('sort') ){
            $exp = explode('|', $req->get('sort'));
            if( count($exp) > 1 ) $query->orderBy($exp[0], $exp[1]);
        }
        if( $req->filled('filter')) {
            $query->orWhere('name', 'LIKE', '%'.$req->get('filter').'%');
        }
        return AppModuleResource::collection($query->paginate(20));
    }

    public function index(){
        return view('app_modules');
    }

}
