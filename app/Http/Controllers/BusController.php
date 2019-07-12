<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Http\Resources\BusResource;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function dataTables( Request $req ){
        $query = Bus::query();
        if( $req->filled('filter')) {
            $query->orWhere('active_plate', 'LIKE', '%'.$req->get('filter').'%')
                  ->orWhere('official_plate', 'LIKE', '%'.$req->get('filter').'%');
        }
        return BusResource::collection($query->paginate(2));
    }

    public function index(){
        return view('buses');
    }

}
