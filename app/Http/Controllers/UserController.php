<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function dataTables( Request $req ){
        $query = User::query();
        if( $req->filled('sort') ){
            $exp = explode('|', $req->get('sort'));
            if( count($exp) > 1 ) $query->orderBy($exp[0], $exp[1]);
        }
        if( $req->filled('filter')) {
            $query->orWhere('name', 'LIKE', '%'.$req->get('filter').'%')
                ->orWhere('name', 'LIKE', '%'.$req->get('filter').'%')
                ->orWhere('citizenship_number', 'LIKE', '%'.$req->get('filter').'%');
        }
        return UserResource::collection($query->paginate(20));
    }

    public function index(){
        return view('users');
    }

}
