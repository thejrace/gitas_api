<?php

namespace App\Http\Controllers\Api;

use App\Bus;
use App\Http\Controllers\Controller;
use App\Http\Resources\BusResource;
use App\Http\Requests\BusFormStoreRequest;
use App\Http\Requests\BusFormUpdateRequest;
use App\Http\Resources\SuccessJSONResponseResource;
use Illuminate\Http\Request;


class BusController extends Controller
{

    public function index( Request $req )
    {
        $query = Bus::query();
        if( $req->filled('sort') ){
            $exp = explode('|', $req->get('sort'));
            $query->orderBy($exp[0], $exp[1]);
        }
        if( $req->filled('filter')) {
            $query->orWhere('active_plate', 'LIKE', '%'.$req->get('filter').'%')
                ->orWhere('official_plate', 'LIKE', '%'.$req->get('filter').'%');
        }
        return BusResource::collection($query->paginate(5));
    }

    public function store(BusFormStoreRequest $request)
    {
        Bus::create( $request->all() );
        return new SuccessJSONResponseResource(null);
    }

    public function show($model)
    {
        return new BusResource($model);
    }

    public function update(BusFormUpdateRequest $request, $model)
    {
        $model->update($request->all());
        return new BusResource($model);
    }

    public function destroy($model)
    {
        $model->delete();
    }
}
