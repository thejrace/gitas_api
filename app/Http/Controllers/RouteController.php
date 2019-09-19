<?php

namespace App\Http\Controllers;

use App\Http\Resources\Api\RouteResource;
use App\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RouteController extends Controller
{
    /**
     * Show index view
     *
     * @return \View
     */
    public function index()
    {
        return view('routes');
    }

    /**
     * Generate datatables data for the frontend
     *
     * @param Request $req
     *
     * @return AnonymousResourceCollection
     */
    public function dataTables(Request $req)
    {
        $query = Route::query();

        if ($req->filled('sort')) {
            $exp = explode('|', $req->get('sort'));
            if (count($exp) > 1) {
                $query->orderBy($exp[0], $exp[1]);
            }
        }

        if ($req->filled('filter')) {
            $query->orWhere('code', 'LIKE', '%' . $req->get('filter') . '%')
                ->orWhere('name', 'LIKE', '%' . $req->get('filter') . '%');
        }

        return RouteResource::collection($query->paginate(20));
    }
}
