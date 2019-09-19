<?php

namespace App\Http\Controllers;

use App\Http\Resources\Api\ServiceResource;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ServiceController extends Controller
{
    /**
     * Show index view
     *
     * @return \View
     */
    public function index()
    {
        return view('services');
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
        $query = Service::query();

        if ($req->filled('sort')) {
            $exp = explode('|', $req->get('sort'));
            if (count($exp) > 1) {
                $query->orderBy($exp[0], $exp[1]);
            }
        }

        if ($req->filled('filter')) {
            $query->orWhere('name', 'LIKE', '%' . $req->get('filter') . '%');
        }

        return ServiceResource::collection($query->paginate(20));
    }
}
