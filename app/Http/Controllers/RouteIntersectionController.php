<?php

namespace App\Http\Controllers;

use App\Http\Resources\Api\RouteIntersectionResource;
use App\RouteIntersection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RouteIntersectionController extends Controller
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
        return view('route_intersections')->with([
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
        $query = RouteIntersection::query();
        $query->where('active_route_id', $routeId);

        if ($req->filled('sort')) {
            $exp = explode('|', $req->get('sort'));
            if (count($exp) > 1) {
                $query->orderBy($exp[0], $exp[1]);
            }
        }

        if ($req->filled('filter')) {
            $query->orWhere('intersected_route', 'LIKE', '%' . $req->get('filter') . '%')
                ->orWhere('stop_name', 'LIKE', '%' . $req->get('filter') . '%')
                ->orWhere('total_diff', 'LIKE', '%' . $req->get('filter') . '%');
        }

        return RouteIntersectionResource::collection($query->paginate(20));
    }
}
