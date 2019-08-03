<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Http\Resources\BusResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BusController extends Controller
{
    /**
     * Generate datatables data for the frontend
     *
     * @param Request $req
     *
     * @return AnonymousResourceCollection
     */
    public function dataTables( Request $req ){
        $query = Bus::query();
        if( $req->filled('sort') ){
            $exp = explode('|', $req->get('sort'));
            if( count($exp) > 1 ) $query->orderBy($exp[0], $exp[1]);
        }
        if( $req->filled('filter')) {
            $query->orWhere('active_plate', 'LIKE', '%'.$req->get('filter').'%')
                  ->orWhere('official_plate', 'LIKE', '%'.$req->get('filter').'%');
        }
        return BusResource::collection($query->paginate(20));
    }

    /**
     * Show index view
     *
     * @return \View
     */
    public function index(){
        return view('buses');
    }
}
