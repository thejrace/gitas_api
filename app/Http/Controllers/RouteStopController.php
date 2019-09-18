<?php

namespace App\Http\Controllers;

use App\Http\Resources\Api\RouteStopResource;
use App\RouteStop;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RouteStopController extends Controller
{
    /**
     * Show index view
     *
     * @param int $routeId
     *
     * @return \View
     */
    public function index($routeId)
    {
        return view('route_stops')->with([
            'parentId' => $routeId,
        ]);
    }

    /**
     * Generate datatables data for the frontend
     *
     * @param Request $req
     * @param int     $routeId
     *
     * @return AnonymousResourceCollection
     */
    public function dataTables(Request $req, $routeId)
    {
        $query = RouteStop::query();
        $query->where('route_id', $routeId);

        if ($req->filled('sort')) {
            $exp = explode('|', $req->get('sort'));
            if (count($exp) > 1) {
                $query->orderBy($exp[0], $exp[1]);
            }
        }

        if ($req->filled('filter')) {
            $query->orWhere('name', 'LIKE', '%' . $req->get('filter') . '%')
                ->orWhere('no', 'LIKE', '%' . $req->get('filter') . '%');
        }

        return RouteStopResource::collection($query->paginate(20));
    }
}
