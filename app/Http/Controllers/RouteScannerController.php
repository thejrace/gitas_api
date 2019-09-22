<?php

namespace App\Http\Controllers;

use App\Http\Resources\Api\RouteScannerResource;
use App\RouteScanner;
use Illuminate\Http\Request;

class RouteScannerController extends Controller
{
    /**
     * Generate datatables data for the frontend
     *
     * @param Request $req
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function dataTables(Request $req)
    {
        $query = RouteScanner::query();
        if ($req->filled('sort')) {
            $exp = explode('|', $req->get('sort'));
            if (count($exp) > 1) {
                $query->orderBy($exp[0], $exp[1]);
            }
        }
        if ($req->filled('filter')) {
            $query->orWhere('code', 'LIKE', '%' . $req->get('filter') . '%');
        }

        return RouteScannerResource::collection($query->paginate(20));
    }

    /**
     * Show index view
     *
     *
     * @return \View
     */
    public function index(Request $request)
    {
        return view('routescanners');
    }
}
